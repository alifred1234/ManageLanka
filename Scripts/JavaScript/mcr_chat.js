///// blue prints
// chat contains
//      receiver [ie. the citizen id and name]],
//      messages
//      unread messages count
/////
// a message contains
//      sender_id,
//      receiver_id,
//      content [ie. message content],
//      timestamp [ie. message timestamp given by the server]

// mount vue js chat app to #mcr_chat
const app = Vue.createApp({
    data() {
        return {
            connectionStatus: 0,
            search: '',
            socketConnection: null,
            mcr: null,
            chats: [],
            _filteredChats: [],
            _selectedChat: {
                message: ''
            },
        };
    },
    computed: {
        filteredChats() {
            return this._filteredChats;
        },
        selectedChat() {
            return this._selectedChat;
        }
    },
    created() {
        getMCR().then((res) => {
            this.mcr = res;
            this.fetchChats().then(() => {
                this.connectToServer(this);
            });
        });
    },
    updated() {
        this._scrollToBottomOfChat();
    },
    methods: {
        sendMessage() {
            // send message content in selectedChat, sender and receiver to server using websocket
            if (this._selectedChat.message !== '') {
                let message = {
                    sender_id: this.mcr.id,
                    sender: {id: this.mcr.id},
                    receiver_id: this._selectedChat.receiver.id,
                    receiver: {id: this._selectedChat.receiver.id},
                    body: this._selectedChat.message
                };
                console.log(message);
                sendMessage(this.socketConnection, message);

                // clear message content
                this._selectedChat.message = "";
            }

        },
        receiveMessage(message) {
            // find chat index with message sender
            let index = this.chats.findIndex((chat) => {
                return chat.receiver.id === message.sender_id || chat.receiver.id === message.receiver_id;
            });
            if (this.chats[index] && index !== -1) {
                this.chats[index].messages.push(message);
            } else {
                //insert new chat as first chat
                this.chats.unshift({
                    receiver: {
                        id: message.sender_id,
                        name: message.sender.name
                    },
                    messages: [message]
                });
            }
            this.filterChats();

        },
        selectChat(chat) {
            this._selectedChat = chat;
        },
        isSelectedChat(chat) {
            return this._selectedChat === chat;
        },
        async fetchChats() {
            axios.get('/api/mcr_chats.php?business_id=' + this.mcr.id).then((response) => {
                this.chats = [];
                Object.keys(response.data).forEach((key) => {
                    // create chat objects
                    let chat = response.data[key];
                    this.chats.push({
                        receiver: {
                            id: chat.receiver.id,
                            name: chat.receiver.name,
                            role: chat.receiver.role
                        },
                        messages: chat.messages,
                        sender: {
                            id: this.mcr.id
                        }
                    });
                });
                // console.log(this.chats);
                this._filteredChats = this.chats;
            });
        },
        filterChats() {
            // this._filteredChats = this.chats.filter(chat =>
            //     chat.name.toLowerCase().indexOf(this.search.toLowerCase()) !== -1);
            // filter chats by search string
            // if search string is empty, set _filteredChats to chats
            if (this.search === '') {
                this._filteredChats = this.chats;
            } else {
                // iterate through chats
                // if search string is found in chat name, add chat to _filteredChats
                this._filteredChats = this.chats.filter(chat => {
                    return chat.receiver.name.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
                });
            }
        },
        connOnOpen(e) {
            this.connectionStatus = 1;
            console.log('connected to server');
            subscribe(this.socketConnection, this.mcr.id);
        },
        connOnClose(e) {
            this.connectionStatus = 0;
            console.log('disconnected from server');
        },
        connOnError(e) {
            this.connectionStatus = 0;
            console.log('connection error');
        },
        connectToServer(app) {
            // connect to websocket server
            app.socketConnection = new WebSocket('ws://localhost:8080/chat');

            app.socketConnection.onopen = app.connOnOpen;

            app.socketConnection.onmessage = function (e) {
                let data = JSON.parse(e.data);
                console.log(data);
                app.receiveMessage(data.message);
            };

            app.socketConnection.onclose = app.connOnClose;
        },
        _scrollToBottomOfChat() {
            const container = this.$el.querySelector("#chat-box");
            container.scrollTop = container.scrollHeight;
        },
    }
});
app.mount('#mcr_chat');

function subscribe(conn, channel) {
    conn.send(JSON.stringify({command: "subscribe", channel: channel}));
}

function sendMessage(conn, msg) {
    conn.send(JSON.stringify({command: "message", message: msg}));
}

//get logged in user business id
async function getUser() {
    let response = await axios.get('/api/user.php');
    if (response.status === 200) {
        return response.data;
    }
    console.log(response);
    return null;
}

async function getMCR() {
    let user = await getUser();
    if (user && user['role'] === 'municipal') {
        return user;
    }
    return null;
}

// update element in array
// let index = this.chats.findIndex(chat => chat.id === msg.sender);
// this.chats[index] = msg;




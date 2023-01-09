///// blue prints
// chat contains
//      receiver [ie. the citizen id and name]],
//      messages
//      unread messages count
/////
// a message contains
//      sender [ie. sender id and name],
//      receiver [ie. receiver id],
//      content [ie. message content],
//      timestamp [ie. message timestamp given by the server]

// mount vue js chat app to #mcr_chat
const app = Vue.createApp({
    data() {
        return {
            connectionStatus: 0,
            socketConnection: null,
            citizen: {
                id: null,
            },
            mcr_id: null,
            _chat: {
                message: '',
                messages: [],
            },
        };
    },
    computed: {
        chat() {
            if (this._chat.messages.length === 0) {
                this.addWelcomeMessage(this._chat);
            }
            return this._chat;
        }
    },
    created() {
        getChatUser().then((res) => {
            this.citizen = res;
            this.fetchChat().then(() => {
                this.connectedToServer(this);
            });
        });
    },
    updated() {
        this._scrollToBottomOfChat();
    },
    methods: {
        addWelcomeMessage(chat) {
            // add welcome message
            chat.messages.push({
                body: 'Greetings, how can I help you?',
                receiver_id: this.citizen.id,
                sender: {id: this.mcr_id},
                sender_id: this.mcr_id,
            });
        },
        isLastMessage(index) {
            return index === this._chat.messages.length - 1;
        },
        sendMessage() {
            // send message content in selectedChat, sender and receiver to server using websocket
            if (this._chat.message !== '') {
                let message = {
                    sender_id: this.citizen.id,
                    sender: this.citizen,
                    receiver_id: this.mcr_id,
                    receiver: {id: this.mcr_id},
                    body: this._chat.message
                };
                sendMessage(this.socketConnection, message);

                // clear message content
                this._chat.message = "";
            }

        },
        receiveMessage(msg) {
            console.log(msg);
            this._chat.messages.push(msg);
        },
        async fetchChat() {
            axios.get('/api/citizen_chat.php?citizen_id=' + this.citizen.id).then((response) => {
                if (response.status === 200) {
                    this._chat.messages = response.data.messages ?? [];
                    this.mcr_id = response.data.mcr_id;
                }
            });
        },
        collapseChat() {
            const chat = document.getElementById('citizen-chat');
            if (chat.classList.contains('collapsed')) {
                chat.classList.remove('collapsed');
                this._scrollToBottomOfChat();
            } else {
                chat.classList.add('collapsed');
            }
        },
        connectedToServer(app) {
            // connect to websocket server
            app.socketConnection = new WebSocket('ws://localhost:8080/chat');

            app.socketConnection.onopen = function (e) {
                app.connectionStatus = 1;
                subscribe(app.socketConnection, app.citizen.id);
                console.log('Chat socket connected');
            }

            app.socketConnection.onmessage = function (e) {
                let data = JSON.parse(e.data);
                app.receiveMessage(data.message);
            }

            app.socketConnection.onclose = function (e) {
                app.connectionStatus = 0;
                console.error('Chat socket closed unexpectedly');
            }
        },
        _scrollToBottomOfChat() {
            const container = document.getElementById("chat-box");
            container.scrollTop = container.scrollHeight;
        },
    }
});
app.mount('#citizen-chat');

//get logged in user business id
async function _getUser() {
    let response = await axios.get('/api/user.php');
    if (response.status === 200) {
        return response.data;
    }
    console.log(response);
    return null;
}

async function getChatUser() {
    let user = await _getUser();
    if (user && (user.role === 'citizen' || user.role === 'recycler')) {
        return user;
    }
    return null;
}

function subscribe(conn, channel) {
    conn.send(JSON.stringify({command: "subscribe", channel: channel}));
}

function sendMessage(conn, msg) {
    conn.send(JSON.stringify({command: "message", message: msg}));
}



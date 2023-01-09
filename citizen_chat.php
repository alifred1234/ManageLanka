<link rel="stylesheet" href="Styles/citizen_chat.css">
<section id="citizen-chat" class="chat collapsible collapsed">
    <div class="header-chat" id="citizen-chat-header" v-on:click="collapseChat()">
        <p class="name">Chat with Municipal Council Representative</p>
    </div>
    <div class="">
        <div class="messages-chat" id="chat-box">
            <div v-for="(msg,index) in chat.messages">
                <!--                    SENDER-->
                <div v-if="msg.sender_id === citizen.id">
                    <div  class="message" >
                        <div class="response">
                            <p class="text"> {{msg.body}} </p>
                        </div>
                    </div>
                    <p v-if="isLastMessage(index)"  class="response-time time" > {{ msg.timestamp }}</p>
                </div>
                <!--                    RECEIVER-->
                <div v-else >
                    <div class="message">
                        <p class="text"> {{msg.body}} </p>
                    </div>
                    <p v-if="isLastMessage(index)"  class="time" > {{ msg.timestamp }}</p>
                </div>
            </div>

        </div>
        <div class="footer-chat">
            <input type="text" class="write-message" v-model="chat.message" v-on:keyup.enter="sendMessage()"
                   placeholder="Type your message here">
            <i v-on:click="sendMessage()"
               class="icon send fa fa-paper-plane-o clickable" aria-hidden="true"></i>
        </div>
    </div>
</section>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="Scripts/JavaScript/citizen_chat.js"></script>
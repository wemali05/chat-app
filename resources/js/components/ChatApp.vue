<template>
    <div class="chat-app">
      <Converstion :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
      <ContactsList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
import  Converstion from './Converstion';
import  ContactsList from './ContactsList';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            }
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
            .listen('NewMessege', (e) => {
                this.handleIncoming(e.message);
            })

            axios.get('/contacts')
            .then((response) => {
                console.log(response.data);
                this.contacts = response.data;
            });
        },

        methods: {
           startConversationWith(contact){
                this.updateUnreadCount(contact, true);

                axios.get(`/conversation/${contact.id}`)
                .then((response) => {
                    this.messages = response.data;
                    this.selectedContact = contact;
            })
           },

           saveNewMessage(message){
               this.messages.push(message);
           },

           handleIncoming(message){
               if(this.selectedContact && message.from == this.selectedContact.id) {
                   this.saveNewMessage(message);
                   return;
               }

                this.updateUnreadCount(message.from_contact, false);
           },

           updateUnreadCount(contact, reset){
               this.contacts = this.contacts.map((single)=> {
                   if(single.id != contact.id){
                       return single;
                   }

                   if(reset)
                     single.unread = 0;
                   else 
                    single.unread += 1;

                    return single;  
               })
           }
        },

        components: { Converstion, ContactsList }
    }
</script>

<style scoped lang="scss">
    .chat-app{
        display: flex;
    }
</style>

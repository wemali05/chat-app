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
            axios.get('/contacts')
            .then((response) => {
                console.log(response.data);
                this.contacts = response.data;
            });
        },

        methods: {
           startConversationWith(contact){
                axios.get(`/conversation/${contact.id}`)
                .then((response) => {
                    this.messages = response.data;
                    this.selectedContact = contact;
            })
           },

           saveNewMessage(text){
               this.messages.push(text);
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

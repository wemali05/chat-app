<template>
    <div class="chat-app">
      <Converstion :contact="selectedContact" :messeges="messeges"/>
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
                messeges: [],
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
                .then((respons) => {
                    this.selected = response.data;
                    this.selectedContact = contact
            })
           }
        },

        components: { Converstion, ContactsList }
    }
</script>

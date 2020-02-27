<template>
    <div class="chat-app">
      <Converstion :contact="selectedContact" :messages="messages"/>
      <ContactsList :contacts="contacts"/>
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
            console.log(this.user);
            axios.get('/contacts')
            .then((response) => {
                console.log(response.data);
                this.contacts = response.data;
            });
        },

        components: { Converstion, ContactsList }
    }
</script>

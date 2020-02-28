<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : 'Select Contact'}}</h1>
        <MessegeFeed :contact="contact" :messages="messages" />
        <MessegeComposer @send="sendMessege" />
    </div>
</template>

<script>
import MessegeFeed from './MessegeFeed';
import MessegeComposer from './MessegeComposer';

export default {
    props: {
        contact: {
            type: Object,
            default: null
        },
        messages: {
            type: Array,
            default: []
        }
    },

    methods: {
        sendMessege(text){
            if(!this.contact){
                return;
            }

            axios.post('/conversation/send', {
                contact_id: this.contact.id,
                text: text
            }).then((response) => {
                this.$emit('new', response.data);
            })
        }
    },

    components: { MessegeFeed, MessegeComposer}
}
</script>

<style scoped lang="scss">
    .conversation{
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        h1 {
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px dashed lightgray;
        }
    }
</style>
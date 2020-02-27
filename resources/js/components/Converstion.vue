<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : 'Select Contact'}}</h1>
        <MessegeFeed :contact="contact" :messeges="messeges" />
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
        messeges: {
            type: Array,
            default: []
        }
    },

    methods: {
        sendMessege(text){
            console.log(text)
        }
    },

    components: { MessegeFeed, MessegeComposer}
}
</script>
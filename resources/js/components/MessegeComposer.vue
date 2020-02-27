<template>
    <div class="composer">
        <textarea v-model="messege" @keydoen.enter="send" placeholder="messege..."></textarea>
    </div>
</template>

<script>
export default {
    data() {
        return {
            messege: ''
        }
    },
    methods: {
        send(){
            if( this.messege = ''){
                return;
            }

            this.$emmit('send', this.messege);
            this.messege = '';
        }
    }
}
</script>
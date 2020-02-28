<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="messege..."></textarea>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: ''
        }
    },
    methods: {
        send(e){
            e.preventDefault();
            
            if( this.message == ''){
                return;
            }

            this.$emit('send', this.message);
            this.message = '';
        }
    }
}
</script>

<style scoped lang="scss">
    .composer{
        textarea{
                width: 96%;
                margin: 10px;
                resize: none;
                border-radius: 3px;
                border: 1px solid lightgray;
                padding: 6px;
        }
    }
</style>
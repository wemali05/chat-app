<template>
    <div class="feed">
        <ul v-if="contact">
            <li v-for="messege in messeges" :message="`message${messege.to == contact.id ? 'sent' : 'received'}`" :key="messege.id">
                <div class="text">
                        {{ messege.text }}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
     props: {
         contact: {
             type: Object,
         },
         messeges: {
             type: Array,
             required: true
         }
     }
}
</script>
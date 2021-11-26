<template>
    <div
         class="flex flex-row items-center p-2 relative rounded"
         :class="classes"
    >
        <div class="absolute text-xs text-gray-500 right-0 top-0 mr-0 mt-3" v-if="userItem.last_message">
            {{ send_at }}
        </div>
        <div class="flex items-center justify-center flex-shrink-0 relative">
            <img :src="userItem.profile_photo_url" :alt="userItem.name" class=" h-10 w-10 rounded-full">
            <div class="h-3 w-3 rounded-full ml-2 absolute right-0 bottom-0"
                :class="is_online?'bg-green-500': 'bg-gray-400'"
            ></div>
        </div>
        <div class="flex flex-col flex-grow ml-3">
            <div class="text-sm md:text-base" :class="userItem.last_message && !userItem.last_message.read_at?'text-indigo-700 font-bold': 'font-samibold'" >{{ userItem.name }}</div>
            <div v-if="typingUsers.indexOf(userItem.id) > -1"  class="text-xs truncate w-40 text-indigo-500">Typing ...</div>
            <div v-else class="text-sm truncate w-40" :class="userItem.last_message && userItem.last_message.read_at?'text-gray-500 font-samibold': 'text-indigo-700 font-bold'">{{ userItem.last_message? userItem.last_message.message:'' }}</div>
        </div>
        <div class="flex-shrink-0 ml-2 self-end mb-1 float-right" v-if="userItem.total_unread > 0">
            <span class="flex items-center justify-center h-5 w-5 bg-red-500 text-white text-xs rounded-full">{{ userItem.total_unread}}</span>
        </div>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    name: "UserItem",
    props:['userItem', 'typingUsers', 'classes', 'is_online'],
    computed: {
        send_at() {
            return this.userItem.last_message? moment(this.userItem.last_message.created_at).format('h:mm a'): '';
        },
    }
}
</script>

<style scoped>

</style>

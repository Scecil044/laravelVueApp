<template>
  <div class="w-full h-full flex flex-col">
    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-white/10 bg-white/80 dark:bg-dark-bg/80">
      <h2 class="text-lg font-bold text-gray-900 dark:text-white">Support Chats</h2>
      <button class="text-brand text-sm font-semibold hover:underline" @click="showNewChat = true">New Chat</button>
    </div>
    <div class="flex-1 overflow-y-auto">
      <div v-if="chats.length === 0" class="flex flex-col items-center justify-center h-full py-12 text-gray-400 dark:text-gray-500">
        <i class="pi pi-comments text-4xl mb-2"></i>
        <span>No support conversations yet.</span>
      </div>
      <ul v-else class="divide-y divide-gray-100 dark:divide-white/10">
        <li v-for="chat in chats" :key="chat.id" @click="$emit('select', chat)"
            :class="[
              'flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-brand/5 dark:hover:bg-brand/10 transition group',
              chat.id === selectedChatId ? 'bg-brand/10 dark:bg-brand/20 border-l-4 border-brand' : ''
            ]">
          <img :src="chat.avatar" class="w-12 h-12 rounded-full object-cover border-2 border-brand" />
          <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between">
              <span class="font-semibold text-gray-900 dark:text-white text-sm text-nowrap">{{ chat.name }}</span>
              <span class="text-xs text-gray-400 dark:text-gray-300 text-nowrap">{{ chat.time }}</span>
            </div>
            <div class="flex items-center gap-2 mt-1">
              <span class="text-xs text-gray-500 dark:text-gray-300 truncate">{{ chat.preview }}</span>
              <span v-if="chat.unread" class="ml-2 bg-brand text-white text-xs rounded-full px-2 py-0.5 font-bold">{{ chat.unread }}</span>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div v-if="showNewChat" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
      <div class="bg-white dark:bg-dark-bg rounded-2xl shadow-xl p-6 w-full max-w-xs border border-white/10">
        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Start New Chat</h3>
        <div class="flex flex-col gap-2 max-h-72 overflow-y-auto">
          <button v-for="user in allUsers" :key="user.id" @click="selectUser(user)"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-brand/10 dark:hover:bg-brand/20 transition">
            <img :src="user.avatar" class="w-8 h-8 rounded-full object-cover border border-brand" />
            <span class="text-sm text-gray-900 dark:text-white text-nowrap">{{ user.name }}</span>
          </button>
        </div>
        <button @click="showNewChat = false" class="mt-4 w-full rounded-lg bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-gray-200 font-semibold py-2 hover:bg-gray-200 dark:hover:bg-white/20 transition">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
const props = defineProps({
  chats: {
    type: Array,
    default: () => []
  },
  allUsers: {
    type: Array,
    default: () => []
  },
  selectedChatId: {
    type: [String, Number],
    default: null
  }
});
const showNewChat = ref(false);
function selectUser(user) {
  showNewChat.value = false;
  // Emit to parent to handle chat creation or selection
  emit('new-chat', user);
}
const emit = defineEmits(['select', 'new-chat']);
</script> 
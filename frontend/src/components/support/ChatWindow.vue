<template>
  <div class="w-full h-full flex flex-col">
    <div class="flex items-center gap-3 px-4 py-3 border-b border-gray-200 dark:border-white/10 bg-white/80 dark:bg-dark-bg/80 relative">
      <img :src="chat?.avatar" class="w-10 h-10 rounded-full object-cover border-2 border-brand" />
      <div class="flex-1 min-w-0">
        <div class="font-semibold text-gray-900 dark:text-white text-sm text-nowrap">{{ chat?.name || 'Support' }}</div>
        <div class="text-xs text-gray-400 dark:text-gray-300">{{ chat?.status || 'Online' }}</div>
      </div>
      <button class="text-gray-400 hover:text-brand transition md:hidden" @click="toggleDropdown"><i class="pi pi-ellipsis-v"></i></button>
      <div v-if="showDropdown" class="absolute right-4 top-14 z-50 bg-white dark:bg-dark-bg rounded-xl shadow-lg border border-gray-100 dark:border-white/10 w-40">
        <button @click="backToList" class="w-full text-left px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-brand/10 dark:hover:bg-brand/20 rounded-t-xl">Back to chats</button>
      </div>
      <slot name="header"></slot>
    </div>
    <div class="flex-1 overflow-y-auto bg-gray-50 dark:bg-dark-bg px-4 py-6 space-y-4">
      <div v-if="!messages || messages.length === 0" class="flex flex-col items-center justify-center h-full py-12 text-gray-400 dark:text-gray-500">
        <i class="pi pi-comments text-4xl mb-2"></i>
        <span>No messages yet. Start the conversation!</span>
      </div>
      <div v-else>
        <MessageBubble
          v-for="msg in messages"
          :key="msg.id"
          :message="msg"
          :isOwn="msg.isOwn"
        />
      </div>
    </div>
    <slot name="input"></slot>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import MessageBubble from './MessageBubble.vue';
const props = defineProps({
  chat: Object,
  messages: Array
});
const emit = defineEmits(['back']);
const showDropdown = ref(false);
function toggleDropdown() {
  showDropdown.value = !showDropdown.value;
}
function backToList() {
  showDropdown.value = false;
  emit('back');
}
</script> 
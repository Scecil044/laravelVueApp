<template>
  <div class="w-full h-full flex flex-col md:flex-row bg-gray-50 dark:bg-dark-bg min-h-screen">
    <div v-if="showList" class="w-full md:w-1/3 lg:w-1/4 h-[60vh] md:h-auto border-r border-gray-200 dark:border-white/10 flex-shrink-0">
      <ChatList :chats="chats" :allUsers="allUsers" :selectedChatId="selectedChatId" @select="handleSelectChat" @new-chat="handleNewChat" />
    </div>
    <div v-if="showChat" class="flex-1 flex flex-col h-[60vh] md:h-auto">
      <ChatWindow :chat="selectedChat" :messages="messages" @back="backToList">
        <template #input>
          <MessageInput @send="sendMessage" @file="sendFile" />
        </template>
        <template #header>
          <button class="md:hidden absolute left-2 top-1/2 -translate-y-1/2 text-2xl text-brand p-2" @click="backToList">
            <i class="pi pi-arrow-left"></i>
          </button>
        </template>
      </ChatWindow>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import ChatList from '@/components/support/ChatList.vue';
import ChatWindow from '@/components/support/ChatWindow.vue';
import MessageInput from '@/components/support/MessageInput.vue';

const allUsers = [
  { id: 1, name: 'Support Agent', avatar: 'https://i.pravatar.cc/150?img=5' },
  { id: 2, name: 'Billing', avatar: 'https://i.pravatar.cc/150?img=6' },
  { id: 3, name: 'Technical Support', avatar: 'https://i.pravatar.cc/150?img=7' },
  { id: 4, name: 'Sales', avatar: 'https://i.pravatar.cc/150?img=8' },
  { id: 5, name: 'Onboarding', avatar: 'https://i.pravatar.cc/150?img=9' },
  { id: 6, name: 'HR', avatar: 'https://i.pravatar.cc/150?img=10' },
  { id: 7, name: 'Product Team', avatar: 'https://i.pravatar.cc/150?img=11' },
  { id: 8, name: 'Security', avatar: 'https://i.pravatar.cc/150?img=12' },
  { id: 9, name: 'Feedback', avatar: 'https://i.pravatar.cc/150?img=13' },
  { id: 10, name: 'Legal', avatar: 'https://i.pravatar.cc/150?img=14' },
  { id: 11, name: 'Marketing', avatar: 'https://i.pravatar.cc/150?img=15' },
  { id: 12, name: 'General Inquiry', avatar: 'https://i.pravatar.cc/150?img=16' },
  { id: 13, name: 'Demo User', avatar: 'https://i.pravatar.cc/150?img=17' },
  { id: 14, name: 'Test User', avatar: 'https://i.pravatar.cc/150?img=18' },
  { id: 15, name: 'Customer Success', avatar: 'https://i.pravatar.cc/150?img=19' }
];

const chats = ref([
  {
    id: 1,
    name: 'Support Agent',
    avatar: 'https://i.pravatar.cc/150?img=5',
    preview: 'How can we help you today?',
    time: '09:30',
    unread: 2,
    status: 'Online'
  },
  {
    id: 2,
    name: 'Billing',
    avatar: 'https://i.pravatar.cc/150?img=6',
    preview: 'Your invoice is ready.',
    time: 'Yesterday',
    unread: 0,
    status: 'Offline'
  },
  {
    id: 3,
    name: 'Technical Support',
    avatar: 'https://i.pravatar.cc/150?img=7',
    preview: 'Please send a screenshot.',
    time: '08:15',
    unread: 1,
    status: 'Online'
  },
  {
    id: 4,
    name: 'Sales',
    avatar: 'https://i.pravatar.cc/150?img=8',
    preview: 'We have a new offer for you!',
    time: 'Monday',
    unread: 0,
    status: 'Online'
  },
  {
    id: 5,
    name: 'Onboarding',
    avatar: 'https://i.pravatar.cc/150?img=9',
    preview: 'Welcome to our platform!',
    time: 'Sunday',
    unread: 0,
    status: 'Offline'
  },
  {
    id: 6,
    name: 'HR',
    avatar: 'https://i.pravatar.cc/150?img=10',
    preview: 'Your leave is approved.',
    time: 'Saturday',
    unread: 0,
    status: 'Online'
  },
  {
    id: 7,
    name: 'Product Team',
    avatar: 'https://i.pravatar.cc/150?img=11',
    preview: 'Feature request noted.',
    time: 'Friday',
    unread: 0,
    status: 'Online'
  },
  {
    id: 8,
    name: 'Security',
    avatar: 'https://i.pravatar.cc/150?img=12',
    preview: 'Password changed successfully.',
    time: 'Thursday',
    unread: 0,
    status: 'Online'
  },
  {
    id: 9,
    name: 'Feedback',
    avatar: 'https://i.pravatar.cc/150?img=13',
    preview: 'Thank you for your feedback!',
    time: 'Wednesday',
    unread: 0,
    status: 'Offline'
  },
  {
    id: 10,
    name: 'Legal',
    avatar: 'https://i.pravatar.cc/150?img=14',
    preview: 'Your contract is ready.',
    time: 'Tuesday',
    unread: 0,
    status: 'Online'
  },
  {
    id: 11,
    name: 'Marketing',
    avatar: 'https://i.pravatar.cc/150?img=15',
    preview: 'Check out our new campaign.',
    time: 'Last week',
    unread: 0,
    status: 'Online'
  },
  {
    id: 12,
    name: 'General Inquiry',
    avatar: 'https://i.pravatar.cc/150?img=16',
    preview: 'How do I reset my password?',
    time: 'Last week',
    unread: 0,
    status: 'Online'
  }
]);

const allMessages = {
  1: [
    { id: 1, text: 'Hello! How can I help you? 😊', time: '09:31', isOwn: false },
    { id: 2, text: 'I have an issue with my account.', time: '09:32', isOwn: true },
    { id: 3, text: 'Can you please provide more details?', time: '09:33', isOwn: false },
    { id: 4, text: 'Sure! Here is a screenshot.', time: '09:34', isOwn: true },
    { id: 5, text: 'Thank you! We are looking into it.', time: '09:35', isOwn: false },
    { id: 6, text: 'Any update? 🤔', time: '09:40', isOwn: true },
    { id: 7, text: 'Yes, please try again now.', time: '09:41', isOwn: false },
    { id: 8, text: 'It works! 🎉', time: '09:42', isOwn: true },
    { id: 9, text: 'Glad to hear that! Let us know if you need anything else.', time: '09:43', isOwn: false },
    { id: 10, text: 'Thanks for your help! 🙏', time: '09:44', isOwn: true }
  ],
  2: [
    { id: 1, text: 'Your invoice is ready.', time: 'Yesterday', isOwn: false },
    { id: 2, text: 'Thank you!', time: 'Yesterday', isOwn: true }
  ],
  3: [
    { id: 1, text: 'Please send a screenshot.', time: '08:15', isOwn: false }
  ],
  4: [
    { id: 1, text: 'We have a new offer for you!', time: 'Monday', isOwn: false }
  ],
  5: [
    { id: 1, text: 'Welcome to our platform!', time: 'Sunday', isOwn: false }
  ],
  6: [
    { id: 1, text: 'Your leave is approved.', time: 'Saturday', isOwn: false }
  ],
  7: [
    { id: 1, text: 'Feature request noted.', time: 'Friday', isOwn: false }
  ],
  8: [
    { id: 1, text: 'Password changed successfully.', time: 'Thursday', isOwn: false }
  ],
  9: [
    { id: 1, text: 'Thank you for your feedback!', time: 'Wednesday', isOwn: false }
  ],
  10: [
    { id: 1, text: 'Your contract is ready.', time: 'Tuesday', isOwn: false }
  ],
  11: [
    { id: 1, text: 'Check out our new campaign.', time: 'Last week', isOwn: false }
  ],
  12: [
    { id: 1, text: 'How do I reset my password?', time: 'Last week', isOwn: false }
  ]
};

const selectedChat = ref(chats.value[0] || null);
const selectedChatId = computed(() => selectedChat.value && selectedChat.value.id ? selectedChat.value.id : null);
const messages = ref(selectedChat.value ? [...allMessages[selectedChat.value.id]] : []);

const isMobile = ref(window.innerWidth < 768);
const showList = computed(() => !isMobile.value || (isMobile.value && !selectedChat.value));
const showChat = computed(() => !isMobile.value || (isMobile.value && selectedChat.value));

window.addEventListener('resize', () => {
  isMobile.value = window.innerWidth < 768;
});

function handleSelectChat(chat) {
  selectChat(chat);
}
function backToList() {
  selectedChat.value = null;
}

watch(selectedChat, (chat) => {
  messages.value = chat && chat.id ? [...(allMessages[chat.id] || [])] : [];
});

function selectChat(chat) {
  selectedChat.value = chat;
}
function handleNewChat(user) {
  let chat = chats.value.find(c => c.id === user.id);
  if (!chat) {
    chat = {
      id: user.id,
      name: user.name,
      avatar: user.avatar,
      preview: '',
      time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
      unread: 0,
      status: 'Online'
    };
    chats.value.unshift(chat);
    allMessages[user.id] = [];
  }
  selectChat(chat);
}
function sendMessage(text) {
  messages.value.push({
    id: Date.now(),
    text,
    time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
    isOwn: true
  });
}
function sendFile(file) {
  messages.value.push({
    id: Date.now(),
    text: file.name,
    file: URL.createObjectURL(file),
    fileType: file.type.startsWith('image') ? 'image' : 'file',
    time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
    isOwn: true
  });
}
</script>

<style scoped>
/* Your styles here */
</style>
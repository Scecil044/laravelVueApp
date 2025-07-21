<template>
  <form @submit.prevent="onSend" class="flex items-end gap-2 px-4 py-3 border-t border-gray-200 dark:border-white/10 bg-white/80 dark:bg-dark-bg/80 relative">
    <div class="relative flex items-center">
      <button type="button" @click="toggleEmoji" class="text-xl text-gray-400 hover:text-brand transition flex items-center"><i class="pi pi-smile"></i></button>
      <div v-if="showEmoji" class="absolute bottom-full left-0 mb-2 z-50">
        <div class="bg-white dark:bg-dark-bg rounded-xl shadow-lg p-3 flex flex-wrap gap-1 w-64 max-h-56 overflow-y-auto border border-gray-100 dark:border-white/10">
          <span v-for="emoji in emojis" :key="emoji" class="cursor-pointer text-xl hover:scale-125 transition" @click="addEmoji(emoji)">{{ emoji }}</span>
        </div>
      </div>
    </div>
    <input
      ref="inputRef"
      v-model="input"
      type="text"
      class="flex-1 rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-white/10 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand transition"
      placeholder="Type a message..."
      @keydown.enter.exact.prevent="onSend"
    />
    <input ref="fileInput" type="file" class="hidden" @change="onFileChange" />
    <button type="button" @click="triggerFile" class="text-xl text-gray-400 hover:text-brand transition"><i class="pi pi-paperclip"></i></button>
    <button type="submit" class="rounded-lg bg-brand text-white px-4 py-2 font-semibold shadow hover:bg-brand/80 transition"><i class="pi pi-send"></i></button>
  </form>
</template>

<script setup>
import { ref, nextTick } from 'vue';
const input = ref('');
const showEmoji = ref(false);
const fileInput = ref(null);
const inputRef = ref(null);
const emojis = [
  '😀','😁','😂','🤣','😃','😄','😅','😆','😉','😊','😋','😎','😍','😘','🥰','😗','😙','😚','🙂','🤗','🤩','🤔','🤨','😐','😑','😶','🙄','😏','😣','😥','😮','🤐','😯','😪','😫','🥱','😴','😌','😛','😜','😝','🤤','😒','😓','😔','😕','🙃','🤑','😲','☹️','🙁','😖','😞','😟','😤','😢','😭','😦','😧','😨','😩','🤯','😬','😰','😱','🥵','🥶','😳','🤪','😵','😡','😠','🤬','😷','🤒','🤕','🤢','🤮','🥴','😇','🥳','🥺','🤠','🤡','🤥','🤫','🤭','🧐','🤓','😈','👿','👹','👺','💀','👻','👽','🤖','💩','😺','😸','😹','😻','😼','😽','🙀','😿','😾'
];

function toggleEmoji() {
  showEmoji.value = !showEmoji.value;
}
function addEmoji(emoji) {
  // Insert emoji at cursor position
  const el = inputRef.value;
  if (el && typeof el.selectionStart === 'number') {
    const start = el.selectionStart;
    const end = el.selectionEnd;
    input.value = input.value.slice(0, start) + emoji + input.value.slice(end);
    nextTick(() => {
      el.setSelectionRange(start + emoji.length, start + emoji.length);
      el.focus();
    });
  } else {
    input.value += emoji;
  }
  showEmoji.value = false;
}
function triggerFile() {
  fileInput.value.click();
}
function onFileChange(e) {
  const file = e.target.files[0];
  if (file) {
    emit('file', file);
  }
}
function onSend() {
  if (input.value.trim()) {
    emit('send', input.value);
    input.value = '';
  }
}
const emit = defineEmits(['send', 'file']);
</script> 
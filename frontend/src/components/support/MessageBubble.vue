<template>
  <div :class="[isOwn ? 'justify-end' : 'justify-start', 'flex w-full']">
    <div :class="[
      'max-w-xs md:max-w-md px-4 py-2 rounded-2xl shadow',
      isOwn
        ? 'bg-brand text-white rounded-br-sm ml-8'
        : 'bg-white dark:bg-white/10 text-gray-900 dark:text-gray-100 rounded-bl-sm mr-8',
      'relative'
    ]">
      <div v-if="message.file" class="mb-2">
        <img v-if="message.fileType === 'image'" :src="message.file" class="rounded-lg max-h-40 object-cover" />
        <a v-else :href="message.file" target="_blank" class="text-xs underline text-brand">Download file</a>
      </div>
      <div class="whitespace-pre-line break-words">{{ message.text }}</div>
      <div class="text-xs text-gray-200 dark:text-gray-400 mt-1 text-right opacity-80">{{ message.time }}</div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  message: Object,
  isOwn: Boolean
});
</script> 
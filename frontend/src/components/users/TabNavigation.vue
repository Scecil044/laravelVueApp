<template>
  <div class="flex gap-2 overflow-x-auto border-b border-gray-100 dark:border-white/10">
    <button
      v-for="tab in tabs"
      :key="tab"
      @click="$emit('update:modelValue', tab)"
      :class="[
        'px-4 py-2 text-sm font-semibold whitespace-nowrap transition rounded-t-lg',
        modelValue === tab
          ? 'text-brand border-b-2 border-brand bg-brand/10 dark:bg-brand/20'
          : 'text-gray-500 dark:text-gray-300 hover:text-brand hover:bg-brand/5 dark:hover:bg-brand/10'
      ]"
    >
      {{ tab }}
    </button>
  </div>
</template>

<script setup>
const props = defineProps({
  tabs: Array,
  modelValue: String
});
</script> 
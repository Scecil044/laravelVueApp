<template>
  <div>
    <!-- Desktop: Vertical Tabs -->
    <div class="hidden md:flex flex-col gap-2 w-48 min-w-[10rem] bg-white/80 dark:bg-dark-bg/80 p-3 rounded-xl shadow text-sm">
      <button
        v-for="tab in tabs"
        :key="tab"
        @click="$emit('update:modelValue', tab)"
        :class="[
          'px-3 py-2 text-left rounded-lg font-semibold transition',
          modelValue === tab ? 'bg-brand/10 dark:bg-brand/20 text-brand' : 'text-gray-700 dark:text-gray-200 hover:bg-brand/5 dark:hover:bg-brand/10'
        ]"
      >
        <i v-if="tab === 'Stats'" class="pi pi-chart-bar mr-2"></i>
        <i v-else-if="tab === 'Requests'" class="pi pi-list mr-2"></i>
        {{ tab }}
      </button>
    </div>
    <!-- Mobile: Horizontal Scroll Tabs -->
    <div class="md:hidden flex gap-2 overflow-x-auto border-b border-gray-100 dark:border-white/10 mb-2">
      <button
        v-for="tab in tabs"
        :key="tab"
        @click="$emit('update:modelValue', tab)"
        :class="[
          'px-3 py-2 text-sm font-semibold whitespace-nowrap transition rounded-t-lg',
          modelValue === tab ? 'text-brand border-b-2 border-brand bg-brand/10 dark:bg-brand/20' : 'text-gray-500 dark:text-gray-300 hover:text-brand hover:bg-brand/5 dark:hover:bg-brand/10'
        ]"
      >
        <i v-if="tab === 'Stats'" class="pi pi-chart-bar mr-2"></i>
        <i v-else-if="tab === 'Requests'" class="pi pi-list mr-2"></i>
        {{ tab }}
      </button>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  tabs: Array,
  modelValue: String
});
</script> 
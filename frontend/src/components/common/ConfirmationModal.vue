<template>
  <transition name="fade">
    <div v-if="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 min-h-screen">
      <div :class="[danger ? 'border-red-200 dark:border-red-500' : 'border-brand', 'bg-white dark:bg-dark-bg rounded-2xl shadow-xl p-5 w-full max-w-md text-sm border-2 flex flex-col items-center']">
        <div class="flex flex-col items-center mb-4">
          <div :class="[danger ? 'bg-red-100 text-red-500 border-red-200 dark:bg-red-900 dark:text-red-400 dark:border-red-500' : 'bg-brand/10 text-brand border-brand', 'rounded-full border-4 w-12 h-12 flex items-center justify-center mb-3']">
            <i :class="[icon || (danger ? 'pi pi-exclamation-circle' : 'pi pi-question-circle'), 'text-3xl']"></i>
          </div>
          <h3 class="text-lg font-extrabold mb-2 text-gray-900 dark:text-white text-center">{{ title }}</h3>
        </div>
        <p class="text-gray-600 dark:text-gray-300 mb-8 text-center text-sm">{{ message }}</p>
        <div class="flex justify-center gap-3 w-full">
          <button @click="$emit('cancel')" class="px-6 py-2 rounded-lg bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-white/20 transition w-32">{{ cancelText || 'Cancel' }}</button>
          <button @click="$emit('confirm')" :class="[danger ? 'bg-red-500 hover:bg-red-600' : 'bg-brand hover:bg-brand/80', 'px-6 py-2 rounded-lg text-white font-semibold transition w-32']">{{ confirmText || 'Confirm' }}</button>
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
defineProps({
  open: Boolean,
  title: { type: String, default: 'Are you sure?' },
  message: { type: String, default: '' },
  confirmText: { type: String, default: 'Confirm' },
  cancelText: { type: String, default: 'Cancel' },
  icon: { type: String, default: '' },
  danger: { type: Boolean, default: false }
});
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.2s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style> 
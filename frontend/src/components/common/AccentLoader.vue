<template>
  <div
    class="flex flex-col items-center justify-center w-full"
    :style="{ minHeight }"
    role="status"
    :aria-label="message"
  >
    <!-- Spinner -->
    <div class="relative mb-6">
      <div class="w-16 h-16 border-4 border-brand/30 border-t-brand rounded-full animate-spin"></div>
      <div class="absolute inset-0 flex items-center justify-center">
        <svg class="w-8 h-8 text-brand animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4m0 8v4m8-8h-4M4 12H8" />
        </svg>
      </div>
    </div>
    <!-- Progress bar -->
    <div v-if="showProgressBar" class="w-48 h-2 bg-slate-200 dark:bg-slate-700/50 rounded-full overflow-hidden mb-4">
      <div class="h-full bg-brand animate-loader-bar" style="width: 60%"></div>
    </div>
    <!-- Loading message -->
    <div class="text-lg font-medium text-brand mb-1 animate-pulse">{{ message }}</div>
    <div v-if="subMessage" class="text-sm text-muted-foreground">{{ subMessage }}</div>
  </div>
</template>

<script setup>
const props = defineProps({
  message: { type: String, default: 'Loading…' },
  subMessage: { type: String, default: 'Please wait while we prepare your experience.' },
  minHeight: { type: String, default: '60vh' },
  showProgressBar: { type: Boolean, default: true },
});
</script>

<style scoped>
@keyframes loader-bar {
  0% { width: 0; }
  50% { width: 80%; }
  100% { width: 60%; }
}
.animate-loader-bar {
  animation: loader-bar 2s infinite ease-in-out;
}
</style>

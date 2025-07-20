<template>
  <div
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-indigo-100 relative overflow-hidden"
  >
    <!-- Decorative background shapes -->
    <div
      class="absolute -top-32 -left-32 w-96 h-96 bg-blue-200 rounded-full opacity-30 blur-2xl animate-pulse"
    ></div>
    <div
      class="absolute -bottom-32 -right-32 w-96 h-96 bg-indigo-200 rounded-full opacity-30 blur-2xl animate-pulse"
    ></div>
    <div
      class="z-10 w-full max-w-md mx-auto p-8 bg-white/90 rounded-2xl shadow-2xl flex flex-col items-center"
    >
      <router-view />
    </div>
  </div>
</template>

<script setup>
// No script needed for layout
</script>

<style scoped>
/* Extra polish for background shapes */
@media (max-width: 640px) {
  .w-96,
  .h-96 {
    width: 16rem;
    height: 16rem;
  }
}
</style>

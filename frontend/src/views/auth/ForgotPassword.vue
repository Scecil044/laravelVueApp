<script setup>
import { ref } from "vue";
import axios from "axios";

const email = ref("");
const loading = ref(false);
const errorMsg = ref("");
const successMsg = ref("");

const emailError = ref("");

const validate = () => {
  if (!email.value) {
    emailError.value = "Email is required.";
    return false;
  }
  emailError.value = "";
  return true;
};

const handleForgot = async () => {
  if (!validate()) return;
  try {
    loading.value = true;
    const response = await axios.post("/auth/forgotPassword", { email: email.value });
    loading.value = false;
    successMsg.value = response.data.message || "If your email exists, a reset link has been sent.";
    errorMsg.value = "";
  } catch (error) {
    loading.value = false;
    errorMsg.value = error.response?.data?.error || "Failed to send reset link. Please try again.";
    successMsg.value = "";
  }
};
</script>

<template>
  <form @submit.prevent="handleForgot" class="space-y-5">
    <div class="text-2xl font-bold text-indigo-400 mb-4 text-center">Forgot Password</div>
    <div class="relative">
      <span class="absolute left-3 top-1/2 -translate-y-1/2 text-indigo-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M16 4H8a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V6a2 2 0 00-2-2z"/>
          <path d="M22 6l-10 7L2 6"/>
        </svg>
      </span>
      <input v-model="email" type="email" class="pl-10 w-full bg-white/80 border border-white/30 rounded-lg py-3 text-gray-900 placeholder-gray-600 focus:ring-2 focus:ring-pink-400 focus:outline-none shadow-[2px_2px_8px_#00000030,-2px_-2px_8px_#ffffff10]" placeholder="you@example.com" required />
      <p v-if="emailError" class="text-red-400 text-xs mt-1 ml-1">{{ emailError }}</p>
    </div>
    <div v-if="successMsg" class="text-green-400 text-center mb-2">{{ successMsg }}</div>
    <div v-if="errorMsg" class="text-red-400 text-center mb-2">{{ errorMsg }}</div>
    <button type="submit" :disabled="loading" class="w-full bg-gradient-to-r from-indigo-500 to-pink-500 py-2 rounded-lg font-bold text-white shadow-lg hover:from-indigo-600 hover:to-pink-600 focus:ring-2 focus:ring-pink-400 transition flex items-center justify-center">
      <span v-if="loading" class="animate-spin rounded-full h-5 w-5 border-t-2 border-b-2 border-white mr-2"></span>
      {{ loading ? 'Sending…' : 'Send Reset Link' }}
    </button>
    <p class="hint mt-6 text-center text-gray-200 text-sm">
      Remembered your password?
      <router-link to="/auth/login" class="font-semibold underline text-indigo-300 hover:text-white">Sign in</router-link>
    </p>
  </form>

</template>

<style scoped>
.shimmer-loader {
  display: inline-block;
  background: linear-gradient(90deg, #e0e7ff 25%, #c7d2fe 50%, #e0e7ff 75%);
  background-size: 200% 100%;
  animation: shimmer 1.2s infinite linear;
}
@keyframes shimmer {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}
</style>
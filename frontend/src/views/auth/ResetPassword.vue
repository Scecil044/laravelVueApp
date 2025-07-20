<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const formData = ref({
  email: "",
  password: "",
  password_confirmation: "",
  token: "",
});

onMounted(() => {
  // Get token and email from URL query parameters
  formData.value.token = route.query.token || "";
  formData.value.email = route.query.email || "";
  
  if (!formData.value.token || !formData.value.email) {
    errorMsg.value = "Invalid password reset link. Please request a new one.";
  }
});
const isLoading = ref(false);
const errorMsg = ref("");
const successMsg = ref("");

const validate = () => {
  if (!formData.value.email || !formData.value.token) {
    errorMsg.value = "Invalid reset link. Please request a new one.";
    return false;
  }
  if (!formData.value.password || !formData.value.password_confirmation) {
    errorMsg.value = "Both password fields are required.";
    return false;
  }
  if (formData.value.password.length < 8) {
    errorMsg.value = "Password must be at least 8 characters.";
    return false;
  }
  if (formData.value.password !== formData.value.password_confirmation) {
    errorMsg.value = "Passwords do not match.";
    return false;
  }
  errorMsg.value = "";
  return true;
};

const submitReset = async () => {
  if (!validate()) return;
  try {
    isLoading.value = true;
    const response = await axios.post("/auth/resetPassword", formData.value);
    isLoading.value = false;
    successMsg.value = response.data.message || "Your password has been reset! You can now sign in.";
    errorMsg.value = "";
    
    // Redirect to login page after 2 seconds
    setTimeout(() => {
      router.push("/auth/login");
    }, 2000);
  } catch (error) {
    isLoading.value = false;
    errorMsg.value = error.response?.data?.error || "Failed to reset password. Please try again.";
    successMsg.value = "";
  }
};
</script>

<template>
  <form @submit.prevent="handleReset" class="space-y-5">
    <div class="text-2xl font-bold text-indigo-400 mb-4 text-center">Reset Password</div>
    <!-- Email Field with Icon -->
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
    <!-- Password Field with Icon -->
    <div class="relative">
      <span class="absolute left-3 top-1/2 -translate-y-1/2 text-indigo-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <rect x="3" y="11" width="18" height="10" rx="2"/>
          <path d="M7 11V7a5 5 0 0110 0v4"/>
        </svg>
      </span>
      <input v-model="password" :type="showPassword ? 'text' : 'password'" class="pl-10 w-full bg-white/80 border border-white/30 rounded-lg py-3 text-gray-900 placeholder-gray-600 focus:ring-2 focus:ring-pink-400 focus:outline-none shadow-[2px_2px_8px_#00000030,-2px_-2px_8px_#ffffff10]" placeholder="New Password" required />
      <button type="button" @click="showPassword = !showPassword" :aria-label="showPassword ? 'Hide password' : 'Show password'" class="absolute right-3 top-1/2 -translate-y-1/2 text-indigo-300 hover:text-white focus:outline-none">
        <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
        <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.7 6.7A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.306M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path d="M3 3l18 18" stroke-linecap="round"/>
        </svg>
      </button>
      <p v-if="passwordError" class="text-red-400 text-xs mt-1 ml-1">{{ passwordError }}</p>
    </div>
    <!-- Confirm Password Field with Icon -->
    <div class="relative">
      <span class="absolute left-3 top-1/2 -translate-y-1/2 text-indigo-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <rect x="3" y="11" width="18" height="10" rx="2"/>
          <path d="M7 11V7a5 5 0 0110 0v4"/>
        </svg>
      </span>
      <input v-model="confirmPassword" :type="showConfirmPassword ? 'text' : 'password'" class="pl-10 w-full bg-white/80 border border-white/30 rounded-lg py-3 text-gray-900 placeholder-gray-600 focus:ring-2 focus:ring-pink-400 focus:outline-none shadow-[2px_2px_8px_#00000030,-2px_-2px_8px_#ffffff10]" placeholder="Confirm Password" required />
      <button type="button" @click="showConfirmPassword = !showConfirmPassword" :aria-label="showConfirmPassword ? 'Hide password' : 'Show password'" class="absolute right-3 top-1/2 -translate-y-1/2 text-indigo-300 hover:text-white focus:outline-none">
        <svg v-if="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
        <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.7 6.7A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.306M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path d="M3 3l18 18" stroke-linecap="round"/>
        </svg>
      </button>
      <p v-if="confirmPasswordError" class="text-red-400 text-xs mt-1 ml-1">{{ confirmPasswordError }}</p>
    </div>
    <div v-if="successMsg" class="text-green-400 text-center mb-2">{{ successMsg }}</div>
    <div v-if="errorMsg" class="text-red-400 text-center mb-2">{{ errorMsg }}</div>
    <button type="submit" :disabled="loading" class="w-full bg-gradient-to-r from-indigo-500 to-pink-500 py-2 rounded-lg font-bold text-white shadow-lg hover:from-indigo-600 hover:to-pink-600 focus:ring-2 focus:ring-pink-400 transition flex items-center justify-center">
      <span v-if="loading" class="animate-spin rounded-full h-5 w-5 border-t-2 border-b-2 border-white mr-2"></span>
      {{ loading ? 'Resetting…' : 'Reset Password' }}
    </button>
    <p class="hint mt-6 text-center text-gray-200 text-sm">
      Back to
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
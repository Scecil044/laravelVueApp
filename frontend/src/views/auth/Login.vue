<script setup>
import { ref } from "vue";
import { useUserStore } from "@/store/useUserStore";
import { useRouter } from "vue-router";

const userStore = useUserStore();
const router = useRouter();
const formData = ref({
  email: "",
  password: "",
});
const isLoading = ref(false);
const errorMsg = ref("");
const showPassword = ref(false);

const validate = () => {
  if (!formData.value.email || !formData.value.password) {
    errorMsg.value = "Email and password are required.";
    return false;
  }
  errorMsg.value = "";
  return true;
};

const loginUser = async () => {
  if (!validate()) return;
  try {
    isLoading.value = true;
    await userStore.login(formData.value);
    if(userStore.isAuthenticated){
          isLoading.value = false;
      router.push("/app/");
    }else{
        isLoading.value = false;
        errorMsg.value = "Invalid credentials. Please try again.";
    }
  } catch (error) {
    isLoading.value = false;
    errorMsg.value = "Login failed. Please check your credentials.";
  }
};
</script>

<template>
  <div class="w-full flex flex-col items-center">
    <!-- Brand/Logo Area -->
    <div class="mb-6 flex flex-col items-center">
      <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center shadow-lg mb-2 animate-fade-in">
        <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
          <path d="M8 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
      <span class="text-xl font-bold text-indigo-700 tracking-wide">Acme Corp</span>
    </div>
    <h2 class="text-3xl font-extrabold text-center text-indigo-800 mb-2 tracking-tight animate-fade-in">Welcome Back</h2>
    <p class="text-center text-gray-500 mb-8 animate-fade-in">Sign in to your account</p>
    <form @submit.prevent="loginUser" class="space-y-6 w-full animate-fade-in-slow">
      <div class="relative">
        <input
          v-model="formData.email"
          type="email"
          id="email"
          name="email"
          required
          class="peer w-full px-4 pt-6 pb-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white/70 backdrop-blur placeholder-transparent transition"
          placeholder="Email address"
          autocomplete="email"
        />
        <label
          for="email"
          class="absolute left-4 top-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm pointer-events-none"
          >Email address</label
        >
      </div>
      <div class="relative">
        <input
          v-model="formData.password"
          :type="showPassword ? 'text' : 'password'"
          id="password"
          name="password"
          required
          class="peer w-full px-4 pt-6 pb-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-white/70 backdrop-blur placeholder-transparent transition pr-12"
          placeholder="Password"
          autocomplete="current-password"
        />
        <label
          for="password"
          class="absolute left-4 top-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm pointer-events-none"
          >Password</label
        >
        <!-- Password visibility toggle -->
        <button type="button" @click="showPassword = !showPassword" tabindex="-1"
          class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-indigo-600 focus:outline-none">
          <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.7 6.7A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.306M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path d="M3 3l18 18" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <div class="flex items-center justify-between">
        <router-link
          to="/auth/forgot-password"
          class="text-indigo-600 hover:underline text-sm font-medium transition-colors"
          >Forgot password?</router-link
        >
      </div>
      <button
        type="submit"
        class="relative w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 text-white font-bold py-3 rounded-lg transition disabled:opacity-60 disabled:cursor-not-allowed shadow-lg overflow-hidden"
        :disabled="isLoading"
      >
        <span v-if="!isLoading" class="flex items-center gap-2">
          <svg
            class="w-5 h-5 mr-1"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 17v1m-6-4V9a6 6 0 1112 0v5m-6 4h6a2 2 0 002-2v-5a2 2 0 00-2-2H6a2 2 0 00-2 2v5a2 2 0 002 2h6z"
            />
          </svg>
          Sign In
        </span>
        <span v-else class="w-full flex items-center justify-center">
          <span class="shimmer-loader h-5 w-5 rounded-full mr-2"></span>
          Signing in...
        </span>
      </button>
      <div v-if="errorMsg" class="text-red-600 text-center mt-2 animate-fade-in">{{ errorMsg }}</div>
    </form>
    <div class="mt-8 text-center text-gray-500 animate-fade-in-slow">
      Don’t have an account?
      <router-link
        to="/register"
        class="text-indigo-600 hover:underline font-medium transition-colors"
        >Sign up</router-link
      >
    </div>
  </div>
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
@keyframes fade-in {
  from { opacity: 0; transform: translateY(16px); }
  to { opacity: 1; transform: none; }
}
.animate-fade-in {
  animation: fade-in 0.7s cubic-bezier(.4,0,.2,1) both;
}
.animate-fade-in-slow {
  animation: fade-in 1.2s cubic-bezier(.4,0,.2,1) both;
}
</style>

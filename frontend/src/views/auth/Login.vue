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
  <div class="w-full">
    <h2
      class="text-3xl font-extrabold text-center text-indigo-800 mb-2 tracking-tight"
    >
      Sign in to your account
    </h2>
    <p class="text-center text-gray-500 mb-8">
      Welcome back! Please enter your details.
    </p>
    <form @submit.prevent="loginUser" class="space-y-6">
      <div class="relative">
        <input
          v-model="formData.email"
          type="email"
          id="email"
          name="email"
          required
          class="peer w-full px-4 pt-6 pb-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-transparent placeholder-transparent transition"
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
          type="password"
          id="password"
          name="password"
          required
          class="peer w-full px-4 pt-6 pb-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 bg-transparent placeholder-transparent transition"
          placeholder="Password"
          autocomplete="current-password"
        />
        <label
          for="password"
          class="absolute left-4 top-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-sm pointer-events-none"
          >Password</label
        >
      </div>
      <div class="flex items-center justify-between">
        <router-link
          to="/forgot-password"
          class="text-indigo-600 hover:underline text-sm font-medium"
          >Forgot password?</router-link
        >
      </div>
      <button
        type="submit"
        class="relative w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 text-white font-bold py-3 rounded-lg transition disabled:opacity-60 disabled:cursor-not-allowed shadow-lg"
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
      <div v-if="errorMsg" class="text-red-600 text-center mt-2">
        {{ errorMsg }}
      </div>
    </form>
    <div class="mt-8 text-center text-gray-500">
      Don’t have an account?
      <router-link
        to="/register"
        class="text-indigo-600 hover:underline font-medium"
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
</style>

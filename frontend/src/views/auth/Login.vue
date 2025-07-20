<!-- LoginPage.vue -->
<template>
  <div>
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-indigo-400 text-center mb-1">Sign in to your account</h2>
      <p class="text-indigo-300 text-center text-sm">Welcome back! Please enter your credentials.</p>
    </div>
    <form @submit.prevent="handleSubmit" class="space-y-5">
      <!-- Email Field with Icon -->
      <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-indigo-300">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M16 4H8a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V6a2 2 0 00-2-2z"/>
            <path d="M22 6l-10 7L2 6"/>
          </svg>
        </span>
        <input
          v-model="email"
          type="email"
          class="pl-10 w-full bg-white/80 border border-white/30 rounded-lg py-3 text-gray-900 placeholder-gray-600 focus:ring-2 focus:ring-pink-400 focus:outline-none shadow-[2px_2px_8px_#00000030,-2px_-2px_8px_#ffffff10]"
          placeholder="you@example.com"
          required
        />
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
        <input
          v-model="password"
          :type="showPassword ? 'text' : 'password'"
          class="pl-10 w-full bg-white/80 border border-white/30 rounded-lg py-3 text-gray-900 placeholder-gray-600 focus:ring-2 focus:ring-pink-400 focus:outline-none shadow-[2px_2px_8px_#00000030,-2px_-2px_8px_#ffffff10]"
          placeholder="••••••••"
          required
        />
        <!-- Show/hide password toggle -->
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
      <!-- Remember me and Forgot password -->
      <div class="flex items-center justify-between mb-2">
        <label class="flex items-center gap-2 text-gray-200 text-sm select-none">
          <input type="checkbox" v-model="rememberMe" class="accent-indigo-500 rounded focus:ring-2 focus:ring-indigo-400" />
          Remember me
        </label>
        <router-link to="/auth/forgot-password" class="text-indigo-300 text-sm font-semibold hover:text-white focus:underline">Forgot password?</router-link>
      </div>
      <!-- Error Message (general) -->
      <div v-if="errorMsg" class="text-red-400 text-center mb-2">{{ errorMsg }}</div>
      <button type="submit" :disabled="loading" class="w-full bg-gradient-to-r from-indigo-500 to-pink-500 py-2 rounded-lg font-bold text-white shadow-lg hover:from-indigo-600 hover:to-pink-600 focus:ring-2 focus:ring-pink-400 transition flex items-center justify-center">
        <span v-if="loading" class="animate-spin rounded-full h-5 w-5 border-t-2 border-b-2 border-white mr-2"></span>
        {{ loading ? 'Signing in…' : 'Sign In' }}
      </button>
      <p class="hint mt-6 text-center text-gray-200 text-sm">
        Need an account?
        <router-link to="/auth/register" class="font-semibold underline text-indigo-300 hover:text-white">Create one</router-link>
      </p>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter} from "vue-router";
import { useUserStore } from "@/store/useUserStore";


const userStore = useUserStore();
const router = useRouter();

const email = ref("");
const password = ref("");
const loading = ref(false);
const showPassword = ref(false);
const emailError = ref("");
const passwordError = ref("");
const errorMsg = ref("");
const rememberMe = ref(false);

const handleSubmit = async () => {
  emailError.value = "";
  passwordError.value = "";
  errorMsg.value = "";

  if (!email.value) {
    emailError.value = "Email is required.";
    return;
  }
  if (!/^\S+@\S+\.\S+$/.test(email.value)) {
    emailError.value = "Please enter a valid email address.";
    return;
  }
  if (!password.value) {
    passwordError.value = "Password is required.";
    return;
  }

  loading.value = true;
  try {
    const formData = {
      email: email.value.trim(),
      password: password.value,
      rememberMe: rememberMe.value,
    };
    const response = await userStore.login(formData);
    if (response && userStore.isAuthenticated === true && response.status === 200) {
      router.push("/app");
    } else {
      errorMsg.value = "Login failed. Please check your credentials.";
    }
  } catch (err) {
    errorMsg.value = "An error occurred. Please try again.";
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  if (window.particlesJS) {
    window.particlesJS("particles-js", {
      particles: {
        number: { value: 40 },
        color: { value: "#ffffff" },
        shape: { type: "circle" },
        opacity: { value: 0.5 },
        size: { value: 3, random: true },
        line_linked: {
          enable: true,
          distance: 150,
          color: "#ffffff",
          opacity: 0.2,
          width: 1,
        },
        move: {
          enable: true,
          speed: 2,
          direction: "none",
          random: false,
          straight: false,
          out_mode: "out",
          bounce: false,
        },
      },
      interactivity: {
        detect_on: "canvas",
        events: {
          onhover: { enable: true, mode: "repulse" },
          resize: true,
        },
      },
    });
  }
});
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap");
* { box-sizing: border-box; }
body, html, #app { margin: 0; height: 100%; font-family: "Poppins", sans-serif; }
.login-wrapper { position: relative; width: 100vw; height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); overflow: hidden; display: flex; align-items: center; justify-content: center; }
.particles { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
.card { position: relative; animation: fadeIn 0.7s ease forwards; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
.hint a { color: #fff; font-weight: 600; text-decoration: none; }
.hint a:hover { text-decoration: underline; }
@media (max-width: 480px) { .card { margin: 0 20px; padding: 30px 20px; } }
</style>

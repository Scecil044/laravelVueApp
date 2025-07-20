<script setup>
import { ref } from "vue";
import { useUserStore } from "@/store/useUserStore";
const userStore = useUserStore();
const formData = ref({
    email: "",
    password: "",
})
const isLoading = ref(false);

const loginUser = async()=>{
    try{
        isLoading.value = true;
        await userStore.login(formData.value);
        isLoading.value = false;
        // Redirect or show success message
    }catch(error){
        isLoading.value = false;
        console.error("Login failed:", error);
    }
}

</script>

<template>
  <div class="Login min-h-screen flex items-center justify-center">
    <form @submit.prevent="loginUser">
        <div class="flex flex-col gap-1">
            <label for="email">Email</label>
            <input type="email" id="Email" name="email" v-model="formData.email" class="w-full border-gray-300" required/>
        </div>
        <div class="flex flex-col gap-1">
            <label for="password">Password</label>
            <input type="password" id="Password" name="password" v-model="formData.password" class="w-full border-gray-300" required/>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</button>
    </form>
  </div>
</template>



<style scoped>
/* Your styles here */
</style>
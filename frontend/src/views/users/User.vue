<template>
  <div class="User min-h-screen flex items-center justify-center">
    <AccentLoader v-if="isLoading" :message="'Loading user...'" :sub-message="'Fetching user details, please wait.'" :show-progress-bar="true" min-height="40vh" />
    <div v-else>
      user{{ formData }}
    </div>
  </div>
</template>

<script setup>
import {ref, onMounted} from "vue";
import { useUserStore } from "@/store/useUserStore";
import { useRoute } from "vue-router";
import AccentLoader from '@/components/common/AccentLoader.vue';

const route = useRoute();

const userId = ref(null);
const isLoading = ref(false);
const formData = ref({});
const errorMsg = ref("");

const userStore = useUserStore()
const fetchUserById = async()=>{
  try{
    isLoading.value = true;
    // Simulate API call delay for loader demo
    await new Promise(r => setTimeout(r, 1800));
    const userData = await userStore.fetchUser({userId: userId.value});
    if (userData && typeof userData === 'object'){
      isLoading.value = false;
      formData.value = userData;
    } else {
      isLoading.value = false;
      setTimeout(()=>{
        errorMsg.value = "User not found!.";
      },1500);
    }
  }catch(error){
    isLoading.value = false;
    console.error("Error fetching user:", error);
  }
}
onMounted(async()=>{
  userId.value = route.params.id;
  await fetchUserById(userId.value);
})
</script>

<style scoped>
/* Your styles here */
</style>
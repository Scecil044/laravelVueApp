<template>
  <div class="User">
    user
  </div>
</template>

<script setup>
import {ref, onMounted} from "vue";
import { useUserStore } from "@/store/useUserStore";
import { useRoute } from "vue-router";

const route = useRoute();

const userId = ref(null);
const isLoading = ref(false);
const formData = ref({});
const errorMsg = ref("");

const userStore = useUserStore()
const fetchUserById = async()=>{
  try{
    isLoading.value = true;
    const userData = await userStore.fetchUser({userId: userId.value});
    if (userData && typeof userData === 'object'){
      isLoading.value = true;
      formData.value = userData;
    } else {
      isLoading.value = false;
      setTimeout(()=>{
        errorMsg.value = "User not found!.";
      },1500);
    }
  }catch(error){
    isLoading.value = true;
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
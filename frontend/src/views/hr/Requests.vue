<template>
  <div class="w-full h-full flex flex-col md:flex-row bg-gray-50 dark:bg-dark-bg min-h-screen">
    <!-- Sidebar Tabs -->
    <div :class="[collapsed ? 'w-16' : 'w-full md:w-56 lg:w-64', 'flex-shrink-0 transition-all duration-300']">
      <div class="flex items-center justify-between md:justify-end p-2 md:p-0">
        <button @click="toggleCollapse" class="md:ml-auto p-2 rounded-lg bg-brand/10 dark:bg-brand/20 text-brand hover:bg-brand/20 dark:hover:bg-brand/30 transition flex items-center justify-center ">
          <i :class="collapsed ? 'pi pi-angle-right' : 'pi pi-angle-left'"></i>
        </button>
      </div>
      <RequestTabs :tabs="tabs" v-model="activeTab" :collapsed="collapsed" />
    </div>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col p-4">
      <component :is="tabComponents[activeTab]" />
    </div>
  </div>
</template>

<script setup>
import { ref, defineAsyncComponent } from 'vue';
import RequestTabs from '@/components/hr/requests/RequestTabs.vue';

const tabs = ['Stats', 'Requests'];
const tabComponents = {
  Stats: defineAsyncComponent(() => import('@/components/hr/requests/RequestStats.vue')),
  Requests: defineAsyncComponent(() => import('@/components/hr/requests/RequestList.vue')),
};
const activeTab = ref('Stats');
const collapsed = ref(false);
function toggleCollapse() {
  collapsed.value = !collapsed.value;
}
</script>

<style scoped>
/* Your styles here */
</style>
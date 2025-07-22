<template>
  <transition name="fade">
    <div v-if="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 min-h-screen">
      <div class="bg-white dark:bg-dark-bg rounded-2xl shadow-xl p-6 w-full max-w-md border border-white/10 relative flex flex-col gap-4">
        <button @click="$emit('close')" class="absolute top-3 right-3 text-gray-400 hover:text-brand text-2xl"><i class="pi pi-times"></i></button>
        <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2 flex items-center gap-2"><i class="pi pi-filter text-brand"></i> Filter Employees</h3>
        <div class="space-y-4">
          <div>
            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Status</label>
            <select v-model="localFilters.status" class="form-input">
              <option value="">All</option>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Department</label>
            <select v-model="localFilters.department" class="form-input">
              <option value="">All</option>
              <option v-for="dept in departments" :key="dept" :value="dept">{{ dept }}</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Employment Type</label>
            <select v-model="localFilters.employmentType" class="form-input">
              <option value="">All</option>
              <option value="Full-time">Full-time</option>
              <option value="Part-time">Part-time</option>
              <option value="Contract">Contract</option>
              <option value="Intern">Intern</option>
              <option value="Consultant">Consultant</option>
            </select>
          </div>
          <div class="flex items-center gap-2">
            <input type="checkbox" v-model="localFilters.onLeave" id="onLeave" class="accent-brand w-4 h-4" />
            <label for="onLeave" class="text-xs font-semibold text-gray-500 dark:text-gray-300">Currently on leave</label>
          </div>
          <div>
            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Sort By</label>
            <select v-model="localFilters.sortBy" class="form-input">
              <option value="">Default</option>
              <option value="name">Name</option>
              <option value="department">Department</option>
              <option value="startDate">Joining Date</option>
            </select>
          </div>
        </div>
        <div class="flex justify-between gap-2 mt-6 sticky bottom-0 bg-white dark:bg-dark-bg py-2">
          <button @click="resetFilters" class="flex-1 px-4 py-2 rounded-lg bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-white/20 transition flex items-center justify-center gap-2"><i class="pi pi-refresh"></i> Reset</button>
          <button @click="applyFilters" class="flex-1 px-4 py-2 rounded-lg bg-brand text-white font-semibold shadow hover:bg-brand/80 transition flex items-center justify-center gap-2"><i class="pi pi-check"></i> Apply</button>
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
const props = defineProps({
  open: Boolean,
  filters: Object,
  departments: Array
});
const emit = defineEmits(['apply', 'close', 'reset']);
const localFilters = ref({ ...props.filters });
watch(() => props.filters, (val) => {
  localFilters.value = { ...val };
});
function resetFilters() {
  localFilters.value = { status: '', department: '', employmentType: '', onLeave: false, sortBy: '' };
  emit('reset');
}
function applyFilters() {
  emit('apply', { ...localFilters.value });
  emit('close');
}
</script>

<style scoped>
.form-input {
  @apply w-full rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-white/10 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand transition;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.2s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style> 
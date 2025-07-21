<template>
  <div class="space-y-6 pl-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Employee ID</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.employeeId || '-' }}</div>
        <input v-else v-model="user.employeeId" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Role</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.jobTitle || '-' }}</div>
        <input v-else v-model="user.jobTitle" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Department</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.department || '-' }}</div>
        <input v-else v-model="user.department" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Manager/Supervisor</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.manager || '-' }}</div>
        <input v-else v-model="user.manager" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Office Location</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.workLocation || '-' }}</div>
        <input v-else v-model="user.workLocation" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Start Date</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.startDate || '-' }}</div>
        <input v-else v-model="user.startDate" type="date" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">End Date</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.endDate || '-' }}</div>
        <input v-else v-model="user.endDate" type="date" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Work Schedule</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.workSchedule || '-' }}</div>
        <input v-else v-model="user.workSchedule" class="form-input" placeholder="e.g. Mon–Fri, 9–5" />
      </div>
    </div>
    <div v-if="editMode" class="flex justify-end">
      <button @click="$emit('save')" class="px-6 py-2 rounded-lg bg-brand text-white font-semibold shadow hover:bg-brand/80 transition text-sm">Save</button>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  user: Object,
  editMode: Boolean
});
</script>

<style scoped>
.form-input {
  @apply w-full rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-white/10 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand transition;
}
</style> 
<template>
  <div class="space-y-6 pl-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Full Name</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.name }}</div>
        <input v-else v-model="user.name" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Email</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.email }}</div>
        <input v-else v-model="user.email" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Phone</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.phone }}</div>
        <input v-else v-model="user.phone" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Job Title</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.jobTitle }}</div>
        <input v-else v-model="user.jobTitle" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Department</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.department }}</div>
        <input v-else v-model="user.department" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Manager</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.manager }}</div>
        <input v-else v-model="user.manager" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Work Location</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.workLocation }}</div>
        <input v-else v-model="user.workLocation" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Status</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.status }}</div>
        <select v-else v-model="user.status" class="form-input">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Start Date</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.startDate }}</div>
        <input v-else v-model="user.startDate" type="date" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Employment Type</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.employmentType }}</div>
        <select v-else v-model="user.employmentType" class="form-input">
          <option value="Full-time">Full-time</option>
          <option value="Part-time">Part-time</option>
          <option value="Contract">Contract</option>
        </select>
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
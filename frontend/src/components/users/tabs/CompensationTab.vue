<template>
  <div class="space-y-6 pl-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Salary</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.salary || '-' }}</div>
        <input v-else v-model="user.salary" type="number" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Pay Frequency</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.payFrequency || '-' }}</div>
        <select v-else v-model="user.payFrequency" class="form-input">
          <option value="Monthly">Monthly</option>
          <option value="Bi-weekly">Bi-weekly</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Bonuses</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.bonuses || '-' }}</div>
        <input v-else v-model="user.bonuses" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Benefits</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.benefits || '-' }}</div>
        <input v-else v-model="user.benefits" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Bank Information</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.bankInfo || '-' }}</div>
        <input v-else v-model="user.bankInfo" class="form-input" />
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
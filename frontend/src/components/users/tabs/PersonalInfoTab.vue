<template>
  <div class="space-y-6 pl-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Date of Birth</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.dob || '-' }}</div>
        <input v-else v-model="user.dob" type="date" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Gender</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.gender || '-' }}</div>
        <select v-else v-model="user.gender" class="form-input">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Marital Status</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.maritalStatus || '-' }}</div>
        <select v-else v-model="user.maritalStatus" class="form-input">
          <option value="Single">Single</option>
          <option value="Married">Married</option>
          <option value="Divorced">Divorced</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Nationality</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.nationality || '-' }}</div>
        <input v-else v-model="user.nationality" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Address</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.address || '-' }}</div>
        <input v-else v-model="user.address" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Emergency Contact</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.emergencyContact || '-' }}</div>
        <input v-else v-model="user.emergencyContact" class="form-input" />
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Languages Spoken</label>
        <div v-if="!editMode" class="text-base text-gray-900 dark:text-white">{{ user.languages || '-' }}</div>
        <input v-else v-model="user.languages" class="form-input" />
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
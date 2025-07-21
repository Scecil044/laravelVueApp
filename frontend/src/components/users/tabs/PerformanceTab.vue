<template>
  <div class="space-y-8 pl-5">
    <div>
      <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Performance Reviews</h3>
      <div v-if="reviews.length === 0" class="text-gray-400 dark:text-gray-500">No reviews yet.</div>
      <ul v-else class="space-y-2">
        <li v-for="review in reviews" :key="review.id" class="p-4 bg-white dark:bg-white/5 rounded-lg shadow border border-gray-100 dark:border-white/10">
          <div class="flex items-center gap-2 mb-1">
            <span class="font-semibold text-brand">{{ review.date }}</span>
            <span class="ml-auto text-xs text-gray-500 dark:text-gray-300">Score: <span class="font-bold text-brand">{{ review.score }}</span></span>
          </div>
          <div class="text-sm text-gray-900 dark:text-white mb-1">{{ review.notes }}</div>
          <div v-if="review.promotion" class="text-xs text-green-500 font-bold">Promotion: {{ review.promotion }}</div>
          <div v-if="review.warning" class="text-xs text-red-500 font-bold">Warning: {{ review.warning }}</div>
        </li>
      </ul>
    </div>
    <div>
      <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">Manager Notes</h3>
      <div v-if="managerNotes.length === 0" class="text-gray-400 dark:text-gray-500">No manager notes.</div>
      <ul v-else class="space-y-2">
        <li v-for="note in managerNotes" :key="note.id" class="p-3 bg-brand/10 dark:bg-brand/20 rounded-lg text-sm text-gray-900 dark:text-white">
          {{ note.text }}
          <div class="text-xs text-gray-500 dark:text-gray-300 mt-1">{{ note.date }}</div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
const reviews = [
  { id: 1, date: '2023-01-10', score: 4.5, notes: 'Excellent performance.', promotion: 'Senior Engineer' },
  { id: 2, date: '2022-07-15', score: 3.8, notes: 'Good, but needs improvement in communication.', warning: 'Late project delivery' }
];
const managerNotes = [
  { id: 1, text: 'Keep up the great work!', date: '2023-02-01' },
  { id: 2, text: 'Focus on time management.', date: '2022-08-10' }
];
</script> 
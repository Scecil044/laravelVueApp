<template>
  <div class="space-y-6">
    <div class="flex justify-between items-center mb-4">
      <h3 class="font-bold text-lg text-gray-900 dark:text-white">Documents</h3>
      <label class="px-4 py-2 rounded-lg bg-brand text-white font-semibold shadow hover:bg-brand/80 transition text-sm cursor-pointer">
        Upload
        <input type="file" class="hidden" @change="onFileChange" multiple />
      </label>
    </div>
    <div v-if="Object.keys(groupedDocs).length === 0" class="text-gray-400 dark:text-gray-500 text-center py-8">
      No documents uploaded yet.
    </div>
    <div v-else>
      <div v-for="(docs, type) in groupedDocs" :key="type" class="mb-6">
        <h4 class="font-semibold text-brand mb-2">{{ type }}</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div v-for="doc in docs" :key="doc.id" class="flex items-center gap-3 p-3 bg-white dark:bg-white/5 rounded-lg shadow border border-gray-100 dark:border-white/10">
            <i :class="doc.icon || 'pi pi-file'" class="text-2xl text-brand"></i>
            <div class="flex-1 min-w-0">
              <div class="font-semibold text-gray-900 dark:text-white text-sm truncate">{{ doc.name }}</div>
              <div class="text-xs text-gray-500 dark:text-gray-300">{{ doc.date }}</div>
            </div>
            <button @click="previewDoc(doc)" class="text-xs text-brand hover:underline">Preview</button>
            <button @click="deleteDoc(doc)" class="text-xs text-red-500 hover:underline ml-2">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="previewUrl" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
      <div class="bg-white dark:bg-dark-bg rounded-2xl shadow-xl p-6 w-full max-w-2xl border border-white/10 relative">
        <button @click="previewUrl = ''" class="absolute top-2 right-2 text-gray-400 hover:text-brand text-2xl"><i class="pi pi-times"></i></button>
        <iframe v-if="isPdf(previewUrl)" :src="previewUrl" class="w-full h-96 rounded-lg"></iframe>
        <img v-else :src="previewUrl" class="w-full max-h-96 rounded-lg object-contain" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
const props = defineProps({
  user: Object,
  editMode: Boolean
});
const docs = ref([
  { id: 1, name: 'ID Card.pdf', type: 'ID', date: '2023-01-10', url: '', icon: 'pi pi-id-card' },
  { id: 2, name: 'Employment Contract.pdf', type: 'Contract', date: '2022-12-01', url: '', icon: 'pi pi-file-pdf' },
  { id: 3, name: 'Certificate.jpg', type: 'Certification', date: '2022-11-15', url: '', icon: 'pi pi-certificate' }
]);
const previewUrl = ref('');
const groupedDocs = computed(() => {
  return docs.value.reduce((acc, doc) => {
    if (!acc[doc.type]) acc[doc.type] = [];
    acc[doc.type].push(doc);
    return acc;
  }, {});
});
function onFileChange(e) {
  // Dummy upload logic
  const files = Array.from(e.target.files);
  files.forEach(file => {
    docs.value.push({
      id: Date.now() + Math.random(),
      name: file.name,
      type: 'Other',
      date: new Date().toISOString().slice(0, 10),
      url: URL.createObjectURL(file),
      icon: 'pi pi-file'
    });
  });
}
function previewDoc(doc) {
  previewUrl.value = doc.url || '';
}
function deleteDoc(doc) {
  docs.value = docs.value.filter(d => d.id !== doc.id);
}
function isPdf(url) {
  return url && url.endsWith('.pdf');
}
</script> 
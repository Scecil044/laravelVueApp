<template>
  <div>
    <!-- Desktop: Vertical Tabs -->
    <div
      :class="[
        'hidden md:flex flex-col gap-2 p-3 rounded-xl shadow text-sm transition-all duration-300',
        collapsed ? 'w-16 items-center' : 'w-full min-w-[10rem] bg-white/80 dark:bg-dark-bg/80'
      ]"
    >
      <button
        v-for="tab in tabs"
        :key="tab"
        @click="$emit('update:modelValue', tab)"
        :class="[
          'flex items-center w-full transition-all duration-200 px-2 py-2 rounded-lg font-semibold',
          modelValue === tab
            ? 'bg-brand/10 dark:bg-brand/20 text-brand'
            : 'text-gray-700 dark:text-gray-200 hover:bg-brand/5 dark:hover:bg-brand/10',
          collapsed ? 'justify-center' : 'justify-start'
        ]"
      >
        <i
          :class="[
            tab === 'Stats' ? 'pi pi-chart-bar' : 'pi pi-list',
            collapsed ? '' : 'mr-2'
          ]"
        ></i>
        <!-- Label with transition -->
        <Transition name="fade-slide">
          <span v-if="!collapsed" class="truncate">{{ tab }}</span>
        </Transition>
      </button>
    </div>

    <!-- Mobile: Horizontal Scroll Tabs -->
    <div class="md:hidden flex gap-2 overflow-x-auto border-b border-gray-100 dark:border-white/10 mb-2">
      <button
        v-for="tab in tabs"
        :key="tab"
        @click="$emit('update:modelValue', tab)"
        :class="[
          'px-3 py-2 text-sm font-semibold whitespace-nowrap transition rounded-t-lg',
          modelValue === tab
            ? 'text-brand border-b-2 border-brand bg-brand/10 dark:bg-brand/20'
            : 'text-gray-500 dark:text-gray-300 hover:text-brand hover:bg-brand/5 dark:hover:bg-brand/10'
        ]"
      >
        <i v-if="tab === 'Stats'" class="pi pi-chart-bar mr-2"></i>
        <i v-else-if="tab === 'Requests'" class="pi pi-list mr-2"></i>
        <span>{{ tab }}</span>
      </button>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  tabs: Array,
  modelValue: String,
  collapsed: {
    type: Boolean,
    default: false
  }
});
</script>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-slide-enter-from,
.fade-slide-leave-to {
  opacity: 0;
  transform: translateX(-10px);
}

.fade-slide-enter-to,
.fade-slide-leave-from {
  opacity: 1;
  transform: translateX(0);
}
</style>


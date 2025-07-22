<template>
  <div class="w-full h-full flex flex-col md:flex-row bg-gray-50 dark:bg-dark-bg min-h-screen">
    <!-- User List -->
    <div v-if="showList" class="w-full md:w-1/3 lg:w-1/4 h-[60vh] md:h-auto border-r border-gray-200 dark:border-white/10 flex-shrink-0 flex flex-col">
      <div class="p-4 border-b border-gray-100 dark:border-white/10 bg-white/80 dark:bg-dark-bg/80 flex items-center gap-2">
        <input v-model="search" type="text" placeholder="Search users..." class="w-full rounded-lg border border-gray-200 dark:border-white/10 bg-white dark:bg-white/10 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand transition" />
        <button @click="showFilter = true" class="ml-2 p-2 rounded-lg bg-brand/10 dark:bg-brand/20 text-brand hover:bg-brand/20 dark:hover:bg-brand/30 transition flex items-center justify-center"><i class="pi pi-filter text-lg"></i></button>
      </div>
      <div class="flex-1 overflow-y-auto">
        <UserListItem
          v-for="user in filteredUsers"
          :key="user.id"
          :user="user"
          :selected="selectedUser && user.id === selectedUser.id"
          @select="selectUser"
        />
      </div>
      <FilterModal
        :open="showFilter"
        :filters="filters"
        :departments="departments"
        @close="showFilter = false"
        @apply="applyFilters"
        @reset="resetFilters"
      />
    </div>
    <!-- User Details -->
    <div v-if="showDetails" class="flex-1 flex flex-col h-[60vh] md:h-auto bg-white/80 dark:bg-dark-bg/80">
      <UserDetailsHeader :user="selectedUser" @edit="editMode = true" />
      <div v-if="selectedUser" class="px-4 pt-4 flex flex-col">
        <TabNavigation :tabs="tabs" v-model="activeTab" />
        <div class="mt-4">
          <component :is="tabComponents[activeTab]" :user="selectedUser" :editMode="editMode" @save="editMode = false" />
        </div>
      </div>
      <button v-if="isMobile" class="md:hidden absolute left-2 top-2 text-2xl text-brand p-2" @click="backToList">
        <i class="pi pi-arrow-left"></i>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, defineAsyncComponent } from 'vue';
import UserListItem from '@/components/users/UserListItem.vue';
import UserDetailsHeader from '@/components/users/UserDetailsHeader.vue';
import TabNavigation from '@/components/users/TabNavigation.vue';
import FilterModal from '@/components/users/FilterModal.vue';

const users = ref([
  {
    id: 1,
    name: 'Jane Doe',
    avatar: 'https://i.pravatar.cc/150?img=5',
    jobTitle: 'Software Engineer',
    department: 'Engineering',
    status: 'Active',
    email: 'jane.doe@example.com',
    phone: '+1234567890',
    manager: 'John Smith',
    workLocation: 'Remote',
    startDate: '2021-01-15',
    employmentType: 'Full-time',
    dob: '1990-05-10',
    gender: 'Female',
    maritalStatus: 'Single',
    nationality: 'Kenyan',
    address: '123 Main St, Nairobi',
    emergencyContact: 'Mary Doe (+254700000000)',
    languages: 'English, Swahili',
    employeeId: 'EMP001',
    endDate: '',
    workSchedule: 'Mon–Fri, 9–5',
    salary: 4500,
    payFrequency: 'Monthly',
    bonuses: 'Annual Bonus',
    benefits: 'Health, Dental',
    bankInfo: 'Equity Bank, 123456789',
  },
  {
    id: 2,
    name: 'John Smith',
    avatar: 'https://i.pravatar.cc/150?img=6',
    jobTitle: 'HR Manager',
    department: 'HR',
    status: 'Active',
    email: 'john.smith@example.com',
    phone: '+1234567891',
    manager: 'CEO',
    workLocation: 'HQ',
    startDate: '2020-03-10',
    employmentType: 'Full-time',
    dob: '1985-08-20',
    gender: 'Male',
    maritalStatus: 'Married',
    nationality: 'Kenyan',
    address: '456 HR Ave, Nairobi',
    emergencyContact: 'Jane Smith (+254711111111)',
    languages: 'English',
    employeeId: 'EMP002',
    endDate: '',
    workSchedule: 'Mon–Fri, 8–5',
    salary: 6000,
    payFrequency: 'Monthly',
    bonuses: 'Quarterly Bonus',
    benefits: 'Health, Pension',
    bankInfo: 'KCB, 987654321',
  },
  {
    id: 3,
    name: 'Mary Wambui',
    avatar: 'https://i.pravatar.cc/150?img=7',
    jobTitle: 'Accountant',
    department: 'Finance',
    status: 'Inactive',
    email: 'mary.wambui@example.com',
    phone: '+1234567892',
    manager: 'John Smith',
    workLocation: 'HQ',
    startDate: '2019-06-01',
    employmentType: 'Part-time',
    dob: '1992-11-30',
    gender: 'Female',
    maritalStatus: 'Single',
    nationality: 'Kenyan',
    address: '789 Finance Rd, Nairobi',
    emergencyContact: 'Peter Wambui (+254722222222)',
    languages: 'English',
    employeeId: 'EMP003',
    endDate: '',
    workSchedule: 'Mon–Wed, 9–3',
    salary: 3000,
    payFrequency: 'Monthly',
    bonuses: '',
    benefits: 'Health',
    bankInfo: 'Co-op Bank, 555555555',
  }
]);
const search = ref('');
const selectedUser = ref(null);
const editMode = ref(false);
const isMobile = ref(window.innerWidth < 768);
const showFilter = ref(false);
const filters = ref({ status: '', department: '', employmentType: '', onLeave: false, sortBy: '' });

const departments = computed(() => {
  const set = new Set(users.value.map(u => u.department).filter(Boolean));
  return Array.from(set);
});

const filteredUsers = computed(() => {
  let list = users.value;
  if (filters.value.status) list = list.filter(u => u.status === filters.value.status);
  if (filters.value.department) list = list.filter(u => u.department === filters.value.department);
  if (filters.value.employmentType) list = list.filter(u => u.employmentType === filters.value.employmentType);
  if (filters.value.onLeave) list = list.filter(u => u.onLeave); // Add onLeave to dummy data if needed
  if (filters.value.sortBy) {
    if (filters.value.sortBy === 'name') list = [...list].sort((a, b) => a.name.localeCompare(b.name));
    if (filters.value.sortBy === 'department') list = [...list].sort((a, b) => a.department.localeCompare(b.department));
    if (filters.value.sortBy === 'startDate') list = [...list].sort((a, b) => new Date(a.startDate) - new Date(b.startDate));
  }
  if (search.value) {
    list = list.filter(u =>
      u.name.toLowerCase().includes(search.value.toLowerCase()) ||
      (u.jobTitle && u.jobTitle.toLowerCase().includes(search.value.toLowerCase())) ||
      (u.department && u.department.toLowerCase().includes(search.value.toLowerCase()))
    );
  }
  return list;
});

const showList = computed(() => !isMobile.value || (isMobile.value && !selectedUser.value));
const showDetails = computed(() => !isMobile.value || (isMobile.value && selectedUser.value));

window.addEventListener('resize', () => {
  isMobile.value = window.innerWidth < 768;
});

function selectUser(user) {
  selectedUser.value = { ...user };
  editMode.value = false;
}
function backToList() {
  selectedUser.value = null;
}
function applyFilters(newFilters) {
  filters.value = { ...newFilters };
}
function resetFilters() {
  filters.value = { status: '', department: '', employmentType: '', onLeave: false, sortBy: '' };
}

const tabs = [
  'Profile',
  'Personal Info',
  'Documents',
  'Work Details',
  'Compensation',
  'Time Off',
  'Performance',
  'Activity Log'
];
const tabComponents = {
  Profile: defineAsyncComponent(() => import('@/components/users/tabs/ProfileTab.vue')),
  'Personal Info': defineAsyncComponent(() => import('@/components/users/tabs/PersonalInfoTab.vue')),
  Documents: defineAsyncComponent(() => import('@/components/users/tabs/DocumentsTab.vue')),
  'Work Details': defineAsyncComponent(() => import('@/components/users/tabs/WorkDetailsTab.vue')),
  Compensation: defineAsyncComponent(() => import('@/components/users/tabs/CompensationTab.vue')),
  'Time Off': defineAsyncComponent(() => import('@/components/users/tabs/TimeOffTab.vue')),
  Performance: defineAsyncComponent(() => import('@/components/users/tabs/PerformanceTab.vue')),
  'Activity Log': defineAsyncComponent(() => import('@/components/users/tabs/ActivityLogTab.vue')),
};
const activeTab = ref('Profile');
</script>

<style scoped>
/* Your styles here */
</style>
import { ref, watchEffect } from 'vue';

const THEME_KEY = 'theme';
const isDark = ref(true);

// Initialize from localStorage or default to dark
if (typeof window !== 'undefined') {
  const saved = localStorage.getItem(THEME_KEY);
  if (saved === 'light') isDark.value = false;
  else isDark.value = true;
}

watchEffect(() => {
  if (typeof window !== 'undefined') {
    const html = document.documentElement;
    if (isDark.value) {
      html.classList.add('dark');
      localStorage.setItem(THEME_KEY, 'dark');
    } else {
      html.classList.remove('dark');
      localStorage.setItem(THEME_KEY, 'light');
    }
  }
});

export function useDarkMode() {
  function toggleDarkMode() {
    isDark.value = !isDark.value;
  }
  return { isDark, toggleDarkMode };
} 
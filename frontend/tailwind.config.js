/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./index.html",
    "./src/**/*.{ts,tsx,vue,js,jsx}",
    "./public/**/*.{ts,tsx,vue,js,jsx}",
  ],
  theme: {
    extend: {
      colors: {
        'dark-bg': '#18181b',
        'brand': '#dd0531',
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
}


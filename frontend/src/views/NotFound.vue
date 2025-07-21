<!-- NotFound.vue -->
<template>
  <div class="error-wrapper min-h-screen flex flex-col items-center justify-center relative">
    <!-- animated background -->
    <div class="particles" id="particles-404"></div>
    <!-- 3-D torus (optional) -->
    <div class="torus-3d"></div>
    <!-- content -->
    <main class="glass-card">
      <h1 class="glitch" data-text="404">404</h1>
      <p class="sub-text">Looks like you’re lost in space.</p>
      <button class="btn-primary" @click="goHome">
        <i class="pi pi-home mr-2"></i>Take me back
      </button>
    </main>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const goHome = () => router.push('/dashboard');

onMounted(() => {
  if (window.particlesJS) {
    window.particlesJS('particles-404', {
      particles: {
        number: { value: 50 },
        color: { value: '#ffffff' },
        shape: { type: 'circle' },
        opacity: { value: 0.4 },
        size: { value: 3, random: true },
        line_linked: {
          enable: true,
          distance: 150,
          color: '#ffffff',
          opacity: 0.15,
          width: 1,
        },
        move: {
          enable: true,
          speed: 2,
          direction: 'none',
          out_mode: 'out',
        },
      },
      interactivity: {
        detect_on: 'canvas',
        events: {
          onhover: { enable: true, mode: 'repulse' },
        },
      },
    });
  }
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

.error-wrapper {
  @apply flex flex-col items-center justify-center w-screen h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black overflow-hidden relative;
}

/* particles & torus are absolute layers */
.particles,
.torus-3d {
  @apply absolute inset-0;
}

/* NotFound.vue  (or AuthLayout.vue) */
.torus-3d {
  position: absolute;
  inset: 0;
  margin: auto;
  width: 240px;
  aspect-ratio: 1;
  background: url("data:image/svg+xml,\<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'>\<defs>\<path id='a' d='M100 20 A80 80 0 1 1 99.9 20' fill='none' stroke='%23ffffff20' stroke-width='2'/>\</defs>\<g opacity='.5'>\<use href='%23a' transform='rotate(0 100 100)'/>\<use href='%23a' transform='rotate(30 100 100)'/>\<use href='%23a' transform='rotate(60 100 100)'/>\<use href='%23a' transform='rotate(90 100 100)'/>\<use href='%23a' transform='rotate(120 100 100)'/>\<use href='%23a' transform='rotate(150 100 100)'/>\<use href='%23a' transform='rotate(180 100 100)'/>\<use href='%23a' transform='rotate(210 100 100)'/>\<use href='%23a' transform='rotate(240 100 100)'/>\<use href='%23a' transform='rotate(270 100 100)'/>\<use href='%23a' transform='rotate(300 100 100)'/>\<use href='%23a' transform='rotate(330 100 100)'/>\</g>\</svg>");
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  animation: rotate3d 40s linear infinite;
  pointer-events: none;
  z-index: 0;
}

@keyframes rotate3d {
  0%   { transform: rotateX(65deg) rotateY(0deg); }
  100% { transform: rotateX(65deg) rotateY(360deg); }
}

/* glass card */
.glass-card {
  @apply relative z-10 bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl text-center px-12 py-16;
}

h1 {
  @apply text-8xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-pink-500;
  font-family: 'Poppins', sans-serif;
  line-height: 1;
}

.glitch {
  position: relative;
  animation: glitch 2.5s infinite;
}
.glitch::before,
.glitch::after {
  content: attr(data-text);
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: inherit;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.glitch::before {
  animation: glitch-1 0.5s infinite;
  clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
}
.glitch::after {
  animation: glitch-2 0.5s infinite;
  clip-path: polygon(0 66%, 100% 66%, 100% 100%, 0 100%);
}
@keyframes glitch {
  0%, 100% { transform: translate(0); }
  20% { transform: translate(-2px, 2px); }
  40% { transform: translate(-2px, -2px); }
  60% { transform: translate(2px, 2px); }
  80% { transform: translate(2px, -2px); }
}
@keyframes glitch-1 {
  0%, 100% { transform: translate(0); }
  20% { transform: translate(-2px, 2px); }
  40% { transform: translate(2px, -2px); }
}
@keyframes glitch-2 {
  0%, 100% { transform: translate(0); }
  20% { transform: translate(2px, -2px); }
  40% { transform: translate(-2px, 2px); }
}

.sub-text {
  @apply text-gray-300 mt-3 mb-8;
}

.btn-primary {
  @apply inline-flex items-center justify-center px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-lg hover:shadow-pink-500/40 transition-all duration-300;
}
</style>
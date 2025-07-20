<!-- AuthLayout.vue -->
<template>
  <div class="login-wrapper min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-gray-800">
    <!-- animated particles -->
    <div class="particles" id="particles-js"></div>

    <!-- 3-D wireframe torus -->
    <div class="torus-3d"></div>

    <!-- glass-morphism card -->
    <main
      class="card bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-6 sm:p-8 w-full max-w-md mx-auto animate-fade-in"
    >
      <router-view />
    </main>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';

onMounted(() => {
  /* particles.js configuration */
  if (window.particlesJS) {
    window.particlesJS('particles-js', {
      particles: {
        number: { value: 40 },
        color: { value: '#ffffff' },
        shape: { type: 'circle' },
        opacity: { value: 0.5 },
        size: { value: 3, random: true },
        line_linked: {
          enable: true,
          distance: 150,
          color: '#ffffff',
          opacity: 0.2,
          width: 1,
        },
        move: {
          enable: true,
          speed: 2,
          direction: 'none',
          random: false,
          straight: false,
          out_mode: 'out',
          bounce: false,
        },
      },
      interactivity: {
        detect_on: 'canvas',
        events: {
          onhover: { enable: true, mode: 'repulse' },
          resize: true,
        },
      },
    });
  }
});
</script>

<style scoped>
/* --- base --- */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
* { box-sizing: border-box; }
body, html, #app { margin: 0; height: 100%; font-family: 'Poppins', sans-serif; }

/* --- layout --- */
.login-wrapper {
  position: relative;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.card {
  position: relative;
  animation: fadeIn 0.7s ease forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 480px) {
  .card {
    margin: 0 20px;
    padding: 30px 20px;
  }
}

/* --- 3-D rotating wireframe torus --- */
.torus-3d {
  position: absolute;
  inset: 0;
  margin: auto;
  width: 220px;
  aspect-ratio: 1;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Cdefs%3E%3Cpath id='a' d='M100 20 A80 80 0 1 1 99.9 20' fill='none' stroke='%23ffffff22' stroke-width='1.5'/%3E%3C/defs%3E%3Cg opacity='.6'%3E%3Cuse href='%23a' transform='rotate(0 100 100)'/%3E%3Cuse href='%23a' transform='rotate(30 100 100)'/%3E%3Cuse href='%23a' transform='rotate(60 100 100)'/%3E%3Cuse href='%23a' transform='rotate(90 100 100)'/%3E%3Cuse href='%23a' transform='rotate(120 100 100)'/%3E%3Cuse href='%23a' transform='rotate(150 100 100)'/%3E%3Cuse href='%23a' transform='rotate(180 100 100)'/%3E%3Cuse href='%23a' transform='rotate(210 100 100)'/%3E%3Cuse href='%23a' transform='rotate(240 100 100)'/%3E%3Cuse href='%23a' transform='rotate(270 100 100)'/%3E%3Cuse href='%23a' transform='rotate(300 100 100)'/%3E%3Cuse href='%23a' transform='rotate(330 100 100)'/%3E%3C/g%3E%3C/svg%3E")
    no-repeat center/contain;
  animation: rotate3d 40s linear infinite;
  pointer-events: none;
}

@keyframes rotate3d {
  0% {
    transform: rotateX(65deg) rotateY(0deg);
  }
  100% {
    transform: rotateX(65deg) rotateY(360deg);
  }
}
</style>
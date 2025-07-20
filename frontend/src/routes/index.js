import { createRouter, createWebHistory } from "vue-router";
import Home from "@/views/Home.vue";
import Dashboard from "@/views/Dashboard.vue";
import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";
import ForgotPassword from "@/views/auth/ForgotPassword.vue";
import ResetPassword from "@/views/auth/ResetPassword.vue";
import Register from "@/views/auth/Register.vue";
import User from "@/views/users/User.vue";
import Users from "@/views/users/Users.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
import AuthLayout from "@/layouts/AuthLayout.vue";
import AppLayout from "@/layouts/AppLayout.vue";

import { useUserStore } from "@/store/useUserStore";

const routes = [
  {
    path: "/",
    name: "GuestLayout",
    component: GuestLayout,
    meta: { requiresAuth: false },
    children: [
      {
        path: "",
        name: "Home",
        component: Home
      }
    ]
  },
  {
    path: "/app",
    name: "AppLayout",
    meta: { requiresAuth: true },
    component: AppLayout,
    children: [
      {
        path: "",
        name: "Dashboard",
        component: Dashboard
      },
      {
        path: "users",
        name: "Users",
        component: Users
      },
      {
        path: "user/:id",
        name: "User",
        component: User
      }
    ]
  },
  // auth routes
  {
    path: "/auth",
    meta: { requiresAuth: false },
    component: AuthLayout,
    name: "AuthLayout",
    children: [
      {
        path: "login",
        name: "Login",
        meta: { requiresAuth: false, guestOnly: true },
        component: Login
      },
      {
        path: "register",
        name: "Register",
        meta: { requiresAuth: false, guestOnly: true },
        component: Register
      },
      {
        path: "forgot-password",
        name: "ForgotPassword",
        meta: { requiresAuth: false, guestOnly: true },
        component: ForgotPassword
      },
      {
        path: "reset-password",
        name: "ResetPassword",
        meta: { requiresAuth: false, guestOnly: true },
        component: ResetPassword
      }
    ]
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Use a function to get the store inside the guard
router.beforeEach((to, from, next) => {
  const userStore = useUserStore();
  const isAuth = userStore.isAuthenticated;
  if (to.meta.guestOnly && isAuth) {
    return next({ name: "Dashboard" });
  }

  if (to.meta.requiresAuth && !isAuth) {
    return next({ name: "Login" });
  }
  next();
});

export default router;

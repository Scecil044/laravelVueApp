import { defineStore } from "pinia";
import axios from "axios";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: null,
    authToken:null,
    isAuthenticated: false,
  }),
  actions: {
    async login(credentials) {
      try {
        const response = await axios.post("/auth/login", credentials);
        this.user = response.data.user;
        this.authToken = response.data.authToken;
        this.isAuthenticated = true;
      } catch (error) {
        console.error("Login failed:", error);
        throw error;
      }
    },
    async register(userData) {
      try {
        const response = await axios.post("/auth/register", userData);
        this.user = response.data.user;
        this.isAuthenticated = true;
      } catch (error) {
        console.error("Registration failed:", error);
        throw error;
      }
    },
    async logout() {
      try {
        this.user = null;
        this.authToken = null;
        this.isAuthenticated = false;
        await axios.post("/auth/logout");
      } catch (error) {
        console.error("Logout failed:", error);
        throw error;
      }
    },
    async fetchUser() {
      try {
        const response = await axios.get("/api/auth/user");
        this.user = response.data.user;
        this.isAuthenticated = true;
      } catch (error) {
        console.error("Failed to fetch user:", error);
        this.user = null;
        this.isAuthenticated = false;
      }
    },
  },
  persist: true, // Enable persistence
});

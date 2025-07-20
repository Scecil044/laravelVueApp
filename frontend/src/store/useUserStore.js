import { defineStore } from "pinia";
import axios from "axios";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: null,
    authToken: null,
    isAuthenticated: false,
    headers: {},
  }),
  actions: {
    async login(credentials) {
      try {
        const response = await axios.post("/auth/login", credentials);
        if (response.data && response.data.user && response.data.authToken) {
          this.user = response.data.user;
          this.authToken = response.data.token;
          this.isAuthenticated = true;
          this.headers = {
            Authorization: `Bearer ${this.authToken}`,
          };
          return response;
        } else {
          this.user = null;
          this.authToken = null;
          this.isAuthenticated = false;
          this.headers = {};
          return false;
        }
      } catch (error) {
        this.user = null;
        this.authToken = null;
        this.isAuthenticated = false;
        this.headers = {};
        throw error;
      }
    },
    async register(userData) {
      try {
        const response = await axios.post("/auth/register", userData);
        if (response.data && response.data.user) {
          this.user = response.data.user;
          this.authToken = response.data.token || null;
          this.isAuthenticated = true;
          this.headers = this.authToken
            ? { Authorization: `Bearer ${this.authToken}` }
            : {};
          return true;
        } else {
          this.user = null;
          this.authToken = null;
          this.isAuthenticated = false;
          this.headers = {};
          return false;
        }
      } catch (error) {
        this.user = null;
        this.authToken = null;
        this.isAuthenticated = false;
        this.headers = {};
        throw error;
      }
    },
    async logout() {
      try {
        this.user = null;
        this.authToken = null;
        this.isAuthenticated = false;
        this.headers = {};
        await axios.post("/auth/logout");
      } catch (error) {
        console.error("Logout failed:", error);
        throw error;
      }
    },
    async fetchUser(formData) {
      try {
        const response = await axios.get(`/users/${formData.userId}`, {
          headers: this.headers,
        });
        if (response.data && response.data.user) {
          this.user = response.data.user;
          this.isAuthenticated = true;
        } else {
          this.user = null;
          this.isAuthenticated = false;
        }
      } catch (error) {
        this.user = null;
        this.isAuthenticated = false;
      }
    },
  },
  persist: true,
});

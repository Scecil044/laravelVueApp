import { defineStore } from "pinia";
import axios from "axios";

export const useUserStore = defineStore("user", {
  state: () => ({
    user: null,
    authToken: null,
    refreshToken:null,
    isAuthenticated: false,
    accessTokenExpires: null,
    refreshTokenExpires: null,
    headers: {},
  }),
  actions: {
    async login(credentials) {
      try {
        const response = await axios.post("/auth/login", credentials);
        if (response.data && response.data.user && response.data.authTokens) {
          this.user = response.data.user;
          this.authToken = response.data.authTokens.access.token;
          this.refreshToken = response.data.authTokens.refresh.token;
          this.refreshTokenExpires = response.data.authTokens.refresh.expires;
          this.accessTokenExpires = response.data.authTokens.access.expires;
          this.isAuthenticated = true;
          this.headers = {
            Authorization: `Bearer ${this.authToken}`,
          };
          return response;
        } else {
          console.log(error)
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
        console.log(error)
        throw error;
      }
    },
    async register(userData) {
      try {
        const response = await axios.post("/auth/register", userData);
        if (response.data && response.data.user) {
          this.user = response.data.user;
          this.authToken = response.data.authToken || null;
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
          return response.data
        } 
      } catch (error) {
        console.error("Fetch user failed:", error);
        throw error;
      }
    },
  },
  persist: true,
});

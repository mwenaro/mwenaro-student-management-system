import axios from "axios";
import env from "configs";
import { LOGIN } from "routes/CONSTANTS";

const service = axios.create({
  baseURL: env.API_BASE_URL,
  timeout: 60000,
});

// API respone interceptor
service.interceptors.response.use(
  (response) => {
    return response.data;
  },
  (error) => {
    const notificationParam = {
      message: "",
      description: "",
    };

    // request happened and server responded

    if (error.response) {
      notificationParam.message = error.response.data.MESSAGE.toString();
      if (error.response.status === 401 || error.response.status === 403) {
        notificationParam.message = "Authentication Fail";
        notificationParam.description = "Please login again";
        localStorage.clear();
        window.location.href = LOGIN;
      }

      if (error.response.status === 404) {
        notificationParam.message = "Not Found";
      }

      if (error.response.status === 500) {
        notificationParam.message = "Internal Server Error";
      }

      if (error.response.status === 508) {
        notificationParam.message = "Time Out";
      }
      if (error.response.status === 422) {
        notificationParam.message = "Validation Error";
      }
      console.log("notificationPram", notificationParam);

      return Promise.reject(error.response.data);
    }
    return Promise.reject(error);
  }
);
export default service;

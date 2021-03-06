import axios from "axios"
import {  decamelizeKeys } from 'humps';
import { ElMessage } from 'element-plus'
import { useUserStore } from "@/store/user"


// create an axios instance
const service = axios.create({
  baseURL: process.env.MIX_APP_BASE_API, // url = base url + request url
  withCredentials: true, // send cookies when cross-domain requests
  timeout: 10000, // request timeout
})

// Request intercepter
service.interceptors.request.use(
  config => {
    const newConfig = { ...config }
    if (config.data) {
      // Convert key to snake case
      newConfig.data = decamelizeKeys(config.data);
    }
    return newConfig;
  },
  error => {
    // Do something with request error
    console.log(error); // for debug
    Promise.reject(error);
  }
);

service.interceptors.response.use(
  response => {
    // if (response.headers.authorization) {
    //   setLogged(response.headers.authorization);
    //   response.data.token = response.headers.authorization;
    // }

    return response.data;
  },
  error => {
    if(error.response.status === 401){
      const store = useUserStore()
      store.logout()
    }

    let message = error.message;
    if (error.response.data && error.response.data.errors) {
      message = error.response.data.errors;
    } else if (error.response.data && error.response.data.message) {
      message = error.response.data.message;
    }

    ElMessage({
      showClose: true,
      message: message,
      type: 'error',
      duration: 5 * 1000,
    });
    return Promise.reject(error);
  }
);
export default service

import axios from "axios";

const api = axios.create({
    baseURL: "https://backend.inbraep/api/",
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json'
    }
});

api.interceptors.request.use((config) => {
return config;
});

export default api;
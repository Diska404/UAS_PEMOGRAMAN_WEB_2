window.API_BASE_URL = window.API_BASE_URL || 'http://localhost:8080/api';

window.api = axios.create({
    baseURL: window.API_BASE_URL,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
    },
});

window.api.interceptors.request.use((config) => {
    const token = localStorage.getItem('auth_token');

    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
});

window.api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 401) {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('auth_user');
            window.dispatchEvent(new Event('auth-changed'));

            if (window.appRouter && window.appRouter.currentRoute.value.path !== '/login') {
                alert('Sesi login berakhir. Silakan login kembali.');
                window.appRouter.push('/login');
            }
        }

        return Promise.reject(error);
    }
);

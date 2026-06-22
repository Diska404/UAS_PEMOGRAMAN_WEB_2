const app = Vue.createApp({
    setup() {
        const isLoggedIn = Vue.ref(!!localStorage.getItem('auth_token'));

        const syncAuth = () => {
            isLoggedIn.value = !!localStorage.getItem('auth_token');
        };

        const logout = async () => {
            try {
                await api.post('/logout');
            } catch (error) {
            }

            localStorage.removeItem('auth_token');
            localStorage.removeItem('auth_user');
            syncAuth();
            router.push('/login');
        };

        Vue.onMounted(() => {
            window.addEventListener('auth-changed', syncAuth);
            window.addEventListener('storage', syncAuth);
        });

        Vue.onUnmounted(() => {
            window.removeEventListener('auth-changed', syncAuth);
            window.removeEventListener('storage', syncAuth);
        });

        return { isLoggedIn, logout };
    },
});

app.use(router);
app.mount('#app');

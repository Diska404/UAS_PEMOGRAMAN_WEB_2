const Login = {
    template: `
        <section class="mx-auto max-w-md">
            <div class="rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-200">
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-slate-900">Login Administrator</h1>
                    <p class="mt-2 text-slate-500">Masuk untuk mengelola data inventaris.</p>
                </div>

                <form @submit.prevent="submitLogin" class="space-y-5">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                        <input v-model="form.email" type="email" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" placeholder="admin@inventory.test" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                        <input v-model="form.password" type="password" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" placeholder="admin123" required>
                    </div>
                    <button type="submit" :disabled="loading" class="w-full rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white hover:bg-slate-700 disabled:cursor-not-allowed disabled:opacity-60">
                        {{ loading ? 'Memproses...' : 'Login' }}
                    </button>
                    <div v-if="error" class="rounded-xl bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">{{ error }}</div>
                </form>

                <div class="mt-6 rounded-2xl bg-slate-100 p-4 text-sm text-slate-600">
                    <p class="font-semibold text-slate-800">Akun default</p>
                    <p>Email: admin@inventory.test</p>
                    <p>Password: admin123</p>
                </div>
            </div>
        </section>
    `,
    setup() {
        const router = VueRouter.useRouter();
        const form = Vue.reactive({ email: 'admin@inventory.test', password: 'admin123' });
        const loading = Vue.ref(false);
        const error = Vue.ref('');

        const submitLogin = async () => {
            loading.value = true;
            error.value = '';

            try {
                const response = await api.post('/login', form);
                localStorage.setItem('auth_token', response.data.token);
                localStorage.setItem('auth_user', JSON.stringify(response.data.user));
                window.dispatchEvent(new Event('auth-changed'));
                router.push('/dashboard');
            } catch (err) {
                error.value = err.response?.data?.messages?.error || err.response?.data?.message || 'Login gagal.';
            } finally {
                loading.value = false;
            }
        };

        return { form, loading, error, submitLogin };
    },
};

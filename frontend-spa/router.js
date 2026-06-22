const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } },
    { path: '/kategori', component: Kategori, meta: { requiresAuth: true } },
    { path: '/supplier', component: Supplier, meta: { requiresAuth: true } },
    { path: '/barang', component: Barang, meta: { requiresAuth: true } },
    { path: '/stok', component: StokHistori, meta: { requiresAuth: true } },
    { path: '/:pathMatch(.*)*', component: NotFound },
];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('auth_token');

    if (to.meta.requiresAuth && !token) {
        next('/login');
        return;
    }

    if (to.path === '/login' && token) {
        next('/dashboard');
        return;
    }

    next();
});

window.appRouter = router;

const Dashboard = {
    template: `
        <section class="space-y-6">
            <div class="flex flex-col justify-between gap-4 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 md:flex-row md:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Dashboard Admin</h1>
                    <p class="mt-1 text-slate-500">Ringkasan data inventaris dan aktivitas stok terbaru.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <router-link to="/kategori" class="rounded-xl bg-slate-100 px-4 py-2 font-semibold text-slate-700 hover:bg-slate-200">Kategori</router-link>
                    <router-link to="/supplier" class="rounded-xl bg-slate-100 px-4 py-2 font-semibold text-slate-700 hover:bg-slate-200">Supplier</router-link>
                    <router-link to="/barang" class="rounded-xl bg-slate-900 px-4 py-2 font-semibold text-white hover:bg-slate-700">Barang</router-link>
                    <router-link to="/stok" class="rounded-xl bg-sky-600 px-4 py-2 font-semibold text-white hover:bg-sky-700">Histori Stok</router-link>
                </div>
            </div>

            <div class="grid gap-5 md:grid-cols-3 xl:grid-cols-6">
                <div v-for="card in cards" :key="card.label" class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-semibold text-slate-500">{{ card.label }}</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">{{ card.value }}</p>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h2 class="text-xl font-bold text-slate-900">Aktivitas Stok Terbaru</h2>
                <div class="mt-5 overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left text-sm">
                        <thead class="bg-slate-100 text-slate-600">
                            <tr>
                                <th class="rounded-l-xl px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Barang</th>
                                <th class="px-4 py-3">Jenis</th>
                                <th class="px-4 py-3">Jumlah</th>
                                <th class="rounded-r-xl px-4 py-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in recentHistori" :key="item.id_histori" class="border-b border-slate-100">
                                <td class="px-4 py-4">{{ item.tanggal }}</td>
                                <td class="px-4 py-4 font-semibold text-slate-800">{{ item.nama_barang }}</td>
                                <td class="px-4 py-4">
                                    <span :class="item.jenis === 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'" class="rounded-full px-3 py-1 text-xs font-bold uppercase">{{ item.jenis }}</span>
                                </td>
                                <td class="px-4 py-4">{{ item.jumlah }} {{ item.satuan }}</td>
                                <td class="px-4 py-4 text-slate-500">{{ item.keterangan || '-' }}</td>
                            </tr>
                            <tr v-if="recentHistori.length === 0">
                                <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada histori stok.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    `,
    setup() {
        const summary = Vue.ref({ recent_histori: [] });
        const recentHistori = Vue.computed(() => summary.value.recent_histori || []);
        const cards = Vue.computed(() => [
            { label: 'Barang', value: summary.value.total_barang ?? 0 },
            { label: 'Kategori', value: summary.value.total_kategori ?? 0 },
            { label: 'Supplier', value: summary.value.total_supplier ?? 0 },
            { label: 'Total Stok', value: summary.value.total_stok ?? 0 },
            { label: 'Stok Menipis', value: summary.value.barang_stok_menipis ?? 0 },
            { label: 'Histori', value: summary.value.total_histori ?? 0 },
        ]);

        const loadSummary = async () => {
            const response = await api.get('/summary');
            summary.value = response.data.data;
        };

        Vue.onMounted(loadSummary);

        return { cards, recentHistori };
    },
};

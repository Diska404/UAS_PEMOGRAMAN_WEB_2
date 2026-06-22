const Home = {
    template: `
        <section class="space-y-8">
            <div class="overflow-hidden rounded-3xl bg-slate-950 text-white shadow-xl ring-1 ring-slate-800">
                <div class="grid gap-8 p-8 md:p-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:p-12">
                    <div class="space-y-7">
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-slate-100 ring-1 ring-white/10">
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                            Inventory Hardware Store
                        </div>
                        <div class="space-y-4">
                            <h1 class="max-w-3xl text-4xl font-bold leading-tight tracking-tight md:text-5xl">Pusat Kontrol Stok untuk Produk Komputer dan Laptop</h1>
                            <p class="max-w-2xl text-lg leading-relaxed text-slate-300">Kelola katalog komponen PC, laptop, peripheral, supplier, dan pergerakan stok harian dalam satu sistem inventaris yang rapi dan mudah dipantau.</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <router-link to="/dashboard" class="rounded-xl bg-white px-5 py-3 font-semibold text-slate-950 shadow-sm hover:bg-slate-200">Buka Dashboard</router-link>
                            <router-link to="/barang" class="rounded-xl border border-white/20 px-5 py-3 font-semibold text-white hover:bg-white/10">Lihat Produk</router-link>
                        </div>
                        <div class="grid max-w-3xl gap-3 pt-2 sm:grid-cols-3">
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <p class="text-sm text-slate-400">Fokus Inventaris</p>
                                <p class="mt-1 font-semibold text-white">Komponen & Laptop</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <p class="text-sm text-slate-400">Monitoring</p>
                                <p class="mt-1 font-semibold text-white">Stok & Supplier</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <p class="text-sm text-slate-400">Aktivitas Gudang</p>
                                <p class="mt-1 font-semibold text-white">Masuk & Keluar</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-3xl border border-white/10 bg-white/10 p-5 shadow-2xl backdrop-blur">
                            <div class="mb-5 flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-slate-300">Ringkasan Operasional</p>
                                    <p class="text-xs text-slate-400">Data aktif dari database inventaris</p>
                                </div>
                                <span class="rounded-full bg-emerald-400/20 px-3 py-1 text-xs font-bold text-emerald-200">Aktif</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div v-for="card in cards" :key="card.label" class="rounded-2xl bg-white p-5 text-slate-950 shadow-sm">
                                    <p class="text-sm font-semibold text-slate-500">{{ card.label }}</p>
                                    <p class="mt-2 text-3xl font-bold">{{ card.value }}</p>
                                    <p class="mt-1 text-xs text-slate-400">{{ card.note }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-white">Stok Perlu Diperhatikan</p>
                                    <p class="text-sm text-slate-400">Produk dengan jumlah rendah</p>
                                </div>
                                <p class="text-3xl font-bold text-white">{{ stockAlert }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-5 lg:grid-cols-3">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-lg font-bold text-white">01</div>
                    <h3 class="mt-5 text-lg font-bold text-slate-900">Katalog Produk Lebih Siap Jual</h3>
                    <p class="mt-3 leading-relaxed text-slate-600">Data produk menyimpan kode item, kategori, supplier, stok, harga, dan spesifikasi singkat agar admin lebih mudah mengecek kebutuhan penjualan.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-lg font-bold text-white">02</div>
                    <h3 class="mt-5 text-lg font-bold text-slate-900">Kontrol Stok Lebih Terpantau</h3>
                    <p class="mt-3 leading-relaxed text-slate-600">Jumlah barang tersedia, produk stok menipis, dan total unit tersimpan dapat dilihat dari dashboard tanpa perlu membuka setiap tabel secara manual.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-lg font-bold text-white">03</div>
                    <h3 class="mt-5 text-lg font-bold text-slate-900">Riwayat Gudang Tercatat</h3>
                    <p class="mt-3 leading-relaxed text-slate-600">Setiap penambahan dan pengurangan stok masuk ke histori sehingga aktivitas gudang dapat ditelusuri kembali saat melakukan pengecekan data.</p>
                </div>
            </div>

            <div class="grid gap-5 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-semibold uppercase tracking-wide text-slate-400">Alur Kerja Admin</p>
                    <h2 class="mt-2 text-2xl font-bold text-slate-900">Dari input produk sampai monitoring stok.</h2>
                    <div class="mt-6 space-y-4">
                        <div class="flex gap-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">1</div>
                            <div>
                                <p class="font-semibold text-slate-900">Daftarkan kategori dan supplier</p>
                                <p class="text-sm leading-relaxed text-slate-500">Kelompokkan produk berdasarkan jenis perangkat dan mitra pengadaan.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">2</div>
                            <div>
                                <p class="font-semibold text-slate-900">Kelola katalog barang</p>
                                <p class="text-sm leading-relaxed text-slate-500">Masukkan detail produk, harga, stok awal, dan spesifikasi utama.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">3</div>
                            <div>
                                <p class="font-semibold text-slate-900">Catat barang masuk dan keluar</p>
                                <p class="text-sm leading-relaxed text-slate-500">Perubahan stok tersimpan sebagai histori untuk kebutuhan audit sederhana.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-wide text-slate-400">Aktivitas Terbaru</p>
                            <h2 class="mt-2 text-2xl font-bold text-slate-900">Pergerakan stok terakhir</h2>
                        </div>
                        <router-link to="/dashboard" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Detail Dashboard</router-link>
                    </div>
                    <div class="mt-5 overflow-hidden rounded-2xl border border-slate-100">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-100 text-slate-600">
                                <tr>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Produk</th>
                                    <th class="px-4 py-3">Jenis</th>
                                    <th class="px-4 py-3">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in recentHistori" :key="item.id_histori" class="border-t border-slate-100">
                                    <td class="px-4 py-3 text-slate-500">{{ formatDate(item.tanggal) }}</td>
                                    <td class="px-4 py-3 font-semibold text-slate-900">{{ item.nama_barang }}</td>
                                    <td class="px-4 py-3">
                                        <span :class="item.jenis === 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'" class="rounded-full px-3 py-1 text-xs font-bold uppercase">{{ item.jenis }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-slate-600">{{ item.jumlah }} {{ item.satuan || 'unit' }}</td>
                                </tr>
                                <tr v-if="recentHistori.length === 0">
                                    <td colspan="4" class="px-4 py-6 text-center text-slate-500">Belum ada aktivitas stok.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    `,
    setup() {
        const summary = Vue.ref({});
        const cards = Vue.computed(() => [
            { label: 'Produk', value: summary.value.total_barang ?? 0, note: 'Item aktif' },
            { label: 'Kategori', value: summary.value.total_kategori ?? 0, note: 'Kelompok produk' },
            { label: 'Supplier', value: summary.value.total_supplier ?? 0, note: 'Mitra toko' },
            { label: 'Total Stok', value: summary.value.total_stok ?? 0, note: 'Unit tersedia' },
        ]);
        const stockAlert = Vue.computed(() => summary.value.barang_stok_menipis ?? 0);
        const recentHistori = Vue.computed(() => summary.value.recent_histori ?? []);

        const loadSummary = async () => {
            try {
                const response = await api.get('/summary');
                summary.value = response.data.data;
            } catch (error) {
                summary.value = {};
            }
        };

        const formatDate = (value) => {
            if (!value) return '-';
            return new Date(value).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
            });
        };

        Vue.onMounted(loadSummary);

        return { cards, stockAlert, recentHistori, formatDate };
    },
};

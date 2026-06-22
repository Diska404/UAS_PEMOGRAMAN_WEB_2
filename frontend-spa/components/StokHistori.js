const StokHistori = {
    template: `
        <section class="space-y-6">
            <div class="flex flex-col justify-between gap-4 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 md:flex-row md:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Histori Stok</h1>
                    <p class="mt-1 text-slate-500">Catat barang masuk dan keluar secara terkontrol.</p>
                </div>
                <button @click="openCreate" class="rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white hover:bg-slate-700">Tambah Histori</button>
            </div>

            <div class="overflow-x-auto rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                <table class="w-full min-w-[880px] text-left text-sm">
                    <thead class="bg-slate-100 text-slate-600">
                        <tr>
                            <th class="px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4">Barang</th>
                            <th class="px-5 py-4">Jenis</th>
                            <th class="px-5 py-4">Jumlah</th>
                            <th class="px-5 py-4">Keterangan</th>
                            <th class="px-5 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.id_histori" class="border-b border-slate-100">
                            <td class="px-5 py-4 text-slate-500">{{ item.tanggal }}</td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-900">{{ item.nama_barang }}</p>
                                <p class="text-xs text-slate-500">{{ item.kode_barang }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <span :class="item.jenis === 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'" class="rounded-full px-3 py-1 text-xs font-bold uppercase">{{ item.jenis }}</span>
                            </td>
                            <td class="px-5 py-4 text-slate-500">{{ item.jumlah }} {{ item.satuan }}</td>
                            <td class="px-5 py-4 text-slate-500">{{ item.keterangan || '-' }}</td>
                            <td class="px-5 py-4 text-right">
                                <button @click="remove(item)" class="rounded-lg bg-rose-100 px-3 py-2 font-semibold text-rose-700 hover:bg-rose-200">Hapus</button>
                            </td>
                        </tr>
                        <tr v-if="items.length === 0">
                            <td colspan="6" class="px-5 py-8 text-center text-slate-500">Data belum tersedia.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 p-4">
                <form @submit.prevent="save" class="w-full max-w-2xl rounded-3xl bg-white p-6 shadow-2xl">
                    <h2 class="text-2xl font-bold text-slate-900">Tambah Histori Stok</h2>
                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Barang</label>
                            <select v-model="form.id_barang" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                                <option value="">Pilih barang</option>
                                <option v-for="item in barang" :key="item.id_barang" :value="item.id_barang">{{ item.kode_barang }} - {{ item.nama_barang }} ({{ item.stok }} {{ item.satuan }})</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Jenis</label>
                            <select v-model="form.jenis" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                                <option value="masuk">Masuk</option>
                                <option value="keluar">Keluar</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Jumlah</label>
                            <input v-model="form.jumlah" type="number" min="1" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal</label>
                            <input v-model="form.tanggal" type="date" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Keterangan</label>
                            <textarea v-model="form.keterangan" class="min-h-24 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200"></textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" @click="closeModal" class="rounded-xl bg-slate-100 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-200">Batal</button>
                        <button type="submit" class="rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white hover:bg-slate-700">Simpan</button>
                    </div>
                </form>
            </div>
        </section>
    `,
    setup() {
        const items = Vue.ref([]);
        const barang = Vue.ref([]);
        const modalOpen = Vue.ref(false);
        const today = new Date().toISOString().slice(0, 10);
        const form = Vue.reactive({ id_barang: '', jenis: 'masuk', jumlah: 1, tanggal: today, keterangan: '' });

        const loadItems = async () => {
            const response = await api.get('/stok');
            items.value = response.data.data;
        };

        const loadBarang = async () => {
            const response = await api.get('/barang');
            barang.value = response.data.data;
        };

        const resetForm = () => {
            form.id_barang = '';
            form.jenis = 'masuk';
            form.jumlah = 1;
            form.tanggal = new Date().toISOString().slice(0, 10);
            form.keterangan = '';
        };

        const openCreate = async () => {
            resetForm();
            await loadBarang();
            modalOpen.value = true;
        };

        const closeModal = () => {
            modalOpen.value = false;
            resetForm();
        };

        const save = async () => {
            await api.post('/stok', { ...form });
            closeModal();
            await loadItems();
        };

        const remove = async (item) => {
            if (!confirm('Hapus histori stok ini?')) {
                return;
            }

            await api.delete(`/stok/${item.id_histori}`);
            await loadItems();
        };

        Vue.onMounted(loadItems);

        return { items, barang, modalOpen, form, openCreate, closeModal, save, remove };
    },
};

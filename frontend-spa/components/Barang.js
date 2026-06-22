const Barang = {
    template: `
        <section class="space-y-6">
            <div class="flex flex-col justify-between gap-4 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 md:flex-row md:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Katalog Produk IT</h1>
                    <p class="mt-1 text-slate-500">Kelola data produk, spesifikasi singkat, stok, harga, kategori, dan supplier.</p>
                </div>
                <button @click="openCreate" class="rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white hover:bg-slate-700">Tambah Produk</button>
            </div>

            <div class="overflow-x-auto rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                <table class="w-full min-w-[1280px] text-left text-sm">
                    <thead class="bg-slate-100 text-slate-600">
                        <tr>
                            <th class="w-[150px] px-5 py-4">Kode</th>
                            <th class="w-[430px] px-5 py-4">Produk dan Spesifikasi</th>
                            <th class="w-[170px] px-5 py-4">Kategori</th>
                            <th class="w-[170px] px-5 py-4">Supplier</th>
                            <th class="w-[120px] px-5 py-4">Stok</th>
                            <th class="w-[150px] px-5 py-4">Harga</th>
                            <th class="w-[150px] px-5 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.id_barang" class="border-b border-slate-100 align-top">
                            <td class="px-5 py-5 font-bold text-slate-900">{{ item.kode_barang }}</td>
                            <td class="px-5 py-5">
                                <p class="font-semibold text-slate-900">{{ item.nama_barang }}</p>
                                <p class="mt-1 max-w-xl text-xs leading-relaxed text-slate-500">{{ item.deskripsi || '-' }}</p>
                            </td>
                            <td class="px-5 py-5 text-slate-500">{{ item.nama_kategori }}</td>
                            <td class="px-5 py-5 text-slate-500">{{ item.nama_supplier }}</td>
                            <td class="px-5 py-5">
                                <span :class="Number(item.stok) <= 5 ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700'" class="rounded-full px-3 py-1 text-xs font-bold">{{ item.stok }} {{ item.satuan }}</span>
                            </td>
                            <td class="px-5 py-5 text-slate-500">{{ currency(item.harga) }}</td>
                            <td class="px-5 py-5 text-right">
                                <button @click="openEdit(item)" class="rounded-lg bg-amber-100 px-3 py-2 font-semibold text-amber-700 hover:bg-amber-200">Edit</button>
                                <button @click="remove(item)" class="ml-2 rounded-lg bg-rose-100 px-3 py-2 font-semibold text-rose-700 hover:bg-rose-200">Hapus</button>
                            </td>
                        </tr>
                        <tr v-if="items.length === 0">
                            <td colspan="7" class="px-5 py-8 text-center text-slate-500">Data belum tersedia.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 p-4">
                <form @submit.prevent="save" class="max-h-[90vh] w-full max-w-4xl overflow-y-auto rounded-3xl bg-white p-6 shadow-2xl">
                    <h2 class="text-2xl font-bold text-slate-900">{{ isEditing ? 'Edit Produk' : 'Tambah Produk' }}</h2>
                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Kode Produk</label>
                            <input v-model="form.kode_barang" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Produk</label>
                            <input v-model="form.nama_barang" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Kategori</label>
                            <select v-model="form.id_kategori" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                                <option value="">Pilih kategori</option>
                                <option v-for="item in kategori" :key="item.id_kategori" :value="item.id_kategori">{{ item.nama_kategori }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Supplier</label>
                            <select v-model="form.id_supplier" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                                <option value="">Pilih supplier</option>
                                <option v-for="item in supplier" :key="item.id_supplier" :value="item.id_supplier">{{ item.nama_supplier }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Stok</label>
                            <input v-model="form.stok" type="number" min="0" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Satuan</label>
                            <input v-model="form.satuan" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" placeholder="unit, pcs, kit" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Harga</label>
                            <input v-model="form.harga" type="number" min="0" step="0.01" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Spesifikasi Singkat</label>
                            <textarea v-model="form.deskripsi" rows="4" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200"></textarea>
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
        const kategori = Vue.ref([]);
        const supplier = Vue.ref([]);
        const modalOpen = Vue.ref(false);
        const isEditing = Vue.ref(false);
        const selectedId = Vue.ref(null);
        const form = Vue.reactive({ id_kategori: '', id_supplier: '', kode_barang: '', nama_barang: '', stok: 0, satuan: 'unit', harga: 0, deskripsi: '' });

        const loadItems = async () => {
            const response = await api.get('/barang');
            items.value = response.data.data;
        };

        const loadOptions = async () => {
            const [kategoriResponse, supplierResponse] = await Promise.all([api.get('/kategori'), api.get('/supplier')]);
            kategori.value = kategoriResponse.data.data;
            supplier.value = supplierResponse.data.data;
        };

        const resetForm = () => {
            form.id_kategori = '';
            form.id_supplier = '';
            form.kode_barang = '';
            form.nama_barang = '';
            form.stok = 0;
            form.satuan = 'unit';
            form.harga = 0;
            form.deskripsi = '';
            selectedId.value = null;
            isEditing.value = false;
        };

        const openCreate = async () => {
            resetForm();
            await loadOptions();
            modalOpen.value = true;
        };

        const openEdit = async (item) => {
            await loadOptions();
            form.id_kategori = item.id_kategori;
            form.id_supplier = item.id_supplier;
            form.kode_barang = item.kode_barang;
            form.nama_barang = item.nama_barang;
            form.stok = item.stok;
            form.satuan = item.satuan;
            form.harga = item.harga;
            form.deskripsi = item.deskripsi || '';
            selectedId.value = item.id_barang;
            isEditing.value = true;
            modalOpen.value = true;
        };

        const closeModal = () => {
            modalOpen.value = false;
            resetForm();
        };

        const save = async () => {
            const payload = { ...form };

            if (isEditing.value) {
                await api.put(`/barang/${selectedId.value}`, payload);
            } else {
                await api.post('/barang', payload);
            }

            closeModal();
            await loadItems();
        };

        const remove = async (item) => {
            if (!confirm(`Hapus produk ${item.nama_barang}?`)) {
                return;
            }

            await api.delete(`/barang/${item.id_barang}`);
            await loadItems();
        };

        const currency = (value) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(Number(value || 0));

        Vue.onMounted(loadItems);

        return { items, kategori, supplier, modalOpen, isEditing, form, openCreate, openEdit, closeModal, save, remove, currency };
    },
};

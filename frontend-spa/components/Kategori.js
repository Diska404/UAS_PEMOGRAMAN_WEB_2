const Kategori = {
    template: `
        <section class="space-y-6">
            <div class="flex flex-col justify-between gap-4 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 md:flex-row md:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Data Kategori</h1>
                    <p class="mt-1 text-slate-500">Kelola kategori barang inventaris.</p>
                </div>
                <button @click="openCreate" class="rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white hover:bg-slate-700">Tambah Kategori</button>
            </div>

            <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-100 text-slate-600">
                        <tr>
                            <th class="px-5 py-4">Nama Kategori</th>
                            <th class="px-5 py-4">Keterangan</th>
                            <th class="px-5 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.id_kategori" class="border-b border-slate-100">
                            <td class="px-5 py-4 font-semibold text-slate-900">{{ item.nama_kategori }}</td>
                            <td class="px-5 py-4 text-slate-500">{{ item.keterangan || '-' }}</td>
                            <td class="px-5 py-4 text-right">
                                <button @click="openEdit(item)" class="rounded-lg bg-amber-100 px-3 py-2 font-semibold text-amber-700 hover:bg-amber-200">Edit</button>
                                <button @click="remove(item)" class="ml-2 rounded-lg bg-rose-100 px-3 py-2 font-semibold text-rose-700 hover:bg-rose-200">Hapus</button>
                            </td>
                        </tr>
                        <tr v-if="items.length === 0">
                            <td colspan="3" class="px-5 py-8 text-center text-slate-500">Data belum tersedia.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 p-4">
                <form @submit.prevent="save" class="w-full max-w-lg rounded-3xl bg-white p-6 shadow-2xl">
                    <h2 class="text-2xl font-bold text-slate-900">{{ isEditing ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>
                    <div class="mt-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Kategori</label>
                            <input v-model="form.nama_kategori" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">Keterangan</label>
                            <textarea v-model="form.keterangan" class="min-h-28 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-900 focus:ring-2 focus:ring-slate-200"></textarea>
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
        const modalOpen = Vue.ref(false);
        const isEditing = Vue.ref(false);
        const selectedId = Vue.ref(null);
        const form = Vue.reactive({ nama_kategori: '', keterangan: '' });

        const loadItems = async () => {
            const response = await api.get('/kategori');
            items.value = response.data.data;
        };

        const resetForm = () => {
            form.nama_kategori = '';
            form.keterangan = '';
            selectedId.value = null;
            isEditing.value = false;
        };

        const openCreate = () => {
            resetForm();
            modalOpen.value = true;
        };

        const openEdit = (item) => {
            form.nama_kategori = item.nama_kategori;
            form.keterangan = item.keterangan || '';
            selectedId.value = item.id_kategori;
            isEditing.value = true;
            modalOpen.value = true;
        };

        const closeModal = () => {
            modalOpen.value = false;
            resetForm();
        };

        const save = async () => {
            if (isEditing.value) {
                await api.put(`/kategori/${selectedId.value}`, form);
            } else {
                await api.post('/kategori', form);
            }

            closeModal();
            await loadItems();
        };

        const remove = async (item) => {
            if (!confirm(`Hapus kategori ${item.nama_kategori}?`)) {
                return;
            }

            await api.delete(`/kategori/${item.id_kategori}`);
            await loadItems();
        };

        Vue.onMounted(loadItems);

        return { items, modalOpen, isEditing, form, openCreate, openEdit, closeModal, save, remove };
    },
};

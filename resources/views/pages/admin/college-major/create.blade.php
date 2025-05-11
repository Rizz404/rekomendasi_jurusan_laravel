<x-admin-layout title="Buat Jurusan">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Buat Jurusan Kuliah Baru</h1>
            <x-ui.link-button href="{{ route('admin.college-majors.index') }}">
                Kembali
            </x-ui.link-button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.college-majors.store') }}"
                    method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.input label="Nama Jurusan" name="major_name"
                            value="{{ old('major_name') }}"
                            placeholder="Masukkan nama jurusan kuliah"
                            required />

                        <x-ui.input label="Fakultas" name="faculty"
                            value="{{ old('faculty') }}"
                            placeholder="Masukkan nama fakultas" required />

                        <x-ui.input label="Studi Pendidikan"
                            name="field_of_study"
                            value="{{ old('field_of_study') }}"
                            placeholder="Masukkan nama studi pendidikan"
                            required />
                    </div>

                    <input type="hidden" name="is_active" value="0">
                    <x-ui.checkbox label="Aktif" name="is_active"
                        checked="old('is_active')" labelPosition="side" />

                    <x-ui.textarea label="Deskripsi" name="description"
                        value="{{ old('description') }}" />

                    <x-ui.textarea label="Prospek Karir" name="career_prospects"
                        value="{{ old('career_prospects') }}" />

                    <div class="flex justify-end mt-6">
                        <x-ui.button type="submit">Simpan Data</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

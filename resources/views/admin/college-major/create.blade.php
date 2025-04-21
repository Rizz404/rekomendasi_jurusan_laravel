<x-user-layout title="Tambah Jurusan">
    <div class=" container max-w-2xl px-4 py-6">
        <form action="{{ route('college-majors.store') }}" method="POST"
            class=" flex flex-col gap-4">

            @csrf

            <x-input label="Nama jurusan" name="major_name"
                placeholder="Masukkan nama jurusan" required />
            <x-input label="Fakultas" name="faculty"
                placeholder="Masukkan nama fakultas" required />
            <x-input label="Bidang studi" name="field_of_study"
                placeholder="Masukkan nama bidang studi" required />
            <x-textarea label="Deskripsi" name="description"
                placeholder="Masukkan deskripsi" />
            <x-textarea label="Prospek karir" name="career_prospects"
                placeholder="Masukkan prospek karir" />
            <x-checkbox label="Aktif" name="is_active" />

            <x-button type="submit">Submit</x-button>
        </form>
    </div>
</x-user-layout>

<x-admin-layout title="Edit Pengguna">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Pengguna</h1>
            <div class="flex space-x-2">
                <x-link-button href="{{ route('admin.users.show', $user) }}">
                    Detail
                </x-link-button>
                <x-link-button href="{{ route('admin.users.index') }}">
                    Kembali
                </x-link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.users.update', $user) }}"
                    method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <h2 class="text-xl font-semibold mb-4">Informasi Akun</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input label="Username" name="username"
                            value="{{ old('username', $user->username) }}"
                            placeholder="Masukkan username" required />

                        <x-input label="Email" name="email" type="email"
                            value="{{ old('email', $user->email) }}"
                            placeholder="Masukkan email" required />

                        <x-input label="No. Telepon" name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            placeholder="Masukkan nomor telepon" />

                        <x-dropdown label="Role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin"
                                {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                Admin</option>
                            <option value="user"
                                {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                                User</option>
                        </x-dropdown>

                        <x-input label="Password Baru" name="password"
                            type="password"
                            placeholder="Kosongkan jika tidak ingin mengubah" />

                        <x-input label="Konfirmasi Password"
                            name="password_confirmation" type="password"
                            placeholder="Konfirmasi password baru" />
                    </div>

                    <h2 class="text-xl font-semibold mb-4 mt-8">Informasi Siswa
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input label="Nama Lengkap" name="name"
                            value="{{ old('name', $user->student?->name) }}"
                            placeholder="Masukkan nama lengkap" required />

                        <x-input label="NIS" name="NIS"
                            value="{{ old('NIS', $user->student?->NIS) }}"
                            placeholder="Masukkan NIS" />

                        <x-dropdown label="Jenis Kelamin" name="gender"
                            required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="man"
                                {{ old('gender', $user->student?->gender) === 'man' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="woman"
                                {{ old('gender', $user->student?->gender) === 'woman' ? 'selected' : '' }}>
                                Perempuan</option>
                        </x-dropdown>

                        <x-input label="Asal Sekolah" name="school_origin"
                            value="{{ old('school_origin', $user->student?->school_origin) }}"
                            placeholder="Masukkan asal sekolah" required />

                        <x-dropdown label="Tipe Sekolah" name="school_type"
                            required>
                            <option value="">Pilih Tipe Sekolah</option>
                            <option value="high_school"
                                {{ old('school_type', $user->student?->school_type) === 'high_school' ? 'selected' : '' }}>
                                SMA</option>
                            <option value="vocational_school"
                                {{ old('school_type', $user->student?->school_type) === 'vocational_school' ? 'selected' : '' }}>
                                SMK</option>
                        </x-dropdown>

                        <x-input label="Jurusan Sekolah" name="school_major"
                            value="{{ old('school_major', $user->student?->school_major) }}"
                            placeholder="Masukkan jurusan sekolah" required />

                        <x-input label="Tahun Lulus" name="graduation_year"
                            type="number"
                            value="{{ old('graduation_year', $user->student?->graduation_year) }}"
                            placeholder="Masukkan tahun lulus" required />
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-button type="submit">Simpan Perubahan</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

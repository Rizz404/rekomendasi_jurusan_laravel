<x-admin-layout title="Detail Pengguna">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Detail Pengguna</h1>
            <div class="flex space-x-2">
                <x-ui.link-button href="{{ route('admin.users.index') }}">
                    Kembali
                </x-ui.link-button>
                <x-ui.link-button href="{{ route('admin.users.edit', $user) }}">
                    Edit
                </x-ui.link-button>
                <form action="{{ route('admin.users.destroy', $user) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <x-ui.button type="submit"
                        class="bg-red-500 hover:bg-red-600">
                        Hapus
                    </x-ui.button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informasi Akun
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Username
                                </p>
                                <p class="font-medium">{{ $user->username }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Email</p>
                                <p class="font-medium">{{ $user->email }}</p>
                                @if ($user->email_verified_at)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Terverifikasi
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Belum Terverifikasi
                                    </span>
                                @endif
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">No.
                                    Telepon</p>
                                <p class="font-medium">
                                    {{ $user->phone ?? 'Tidak ada' }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Role</p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tanggal
                                    Registrasi</p>
                                <p class="font-medium">
                                    {{ $user->created_at->format('d F Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informasi Siswa
                        </h2>
                        @if ($user->student)
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-teto-dark-text">Nama
                                        Lengkap</p>
                                    <p class="font-medium">
                                        {{ $user->student->name }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-teto-dark-text">NIS
                                    </p>
                                    <p class="font-medium">
                                        {{ $user->student->NIS ?? 'Tidak ada' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-teto-dark-text">Jenis
                                        Kelamin</p>
                                    <p class="font-medium">
                                        {{ $user->student->gender === 'man' ? 'Laki-laki' : 'Perempuan' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-teto-dark-text">Asal
                                        Sekolah</p>
                                    <p class="font-medium">
                                        {{ $user->student->school_origin }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-teto-dark-text">Tipe
                                        Sekolah</p>
                                    <p class="font-medium">
                                        {{ $user->student->school_type === 'high_school' ? 'SMA' : 'SMK' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-teto-dark-text">
                                        Jurusan</p>
                                    <p class="font-medium">
                                        {{ $user->student->school_major }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-teto-dark-text">Tahun
                                        Lulus
                                    </p>
                                    <p class="font-medium">
                                        {{ $user->student->graduation_year }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-md p-4">
                                <p class="text-teto-dark-text">Tidak ada data
                                    siswa
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

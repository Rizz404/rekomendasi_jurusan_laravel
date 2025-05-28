<x-app title="Home">
    <x-header />

    @php
        $alertTypes = ['success', 'error', 'warning', 'info'];
    @endphp


    <div class="container px-4 mx-auto my-4">
        @foreach ($alertTypes as $type)
            @if (session()->has($type))
                <x-ui.alert type="{{ $type }}">
                    {{ session($type) }}
                </x-ui.alert>
            @endif
        @endforeach
    </div>


    <div class="container px-4 py-2 mx-auto">
        <section
            class="bg-teto-cream rounded-lg shadow-md p-12 md:p-16 text-center">

            <h1 class="text-4xl md:text-5xl font-bold text-teto-primary">
                Temukan Jurusan Kuliah Yang Tepat Untuk Masa Depanmu</h1>

            <p class="mt-4 text-lg text-teto-dark-text-soft max-w-3xl mx-auto">

                Sistem rekomendasi jurusan kuliah berbasis metode Simple
                Additive Weighting (SAW) yang membantu kamu menemukan jurusan
                terbaik sesuai minat, bakat, dan nilai akademismu.
            </p>
            <div class="mt-8 flex justify-center items-center">

                <a href="{{ route('login') }}"
                    class="text-xl md:text-2xl inline-flex items-center justify-center px-8 py-4 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-teto-primary text-white hover:bg-teto-primary-hover focus:ring-teto-primary shadow hover:shadow-lg">

                    Mulai Sekarang
                </a>
            </div>
        </section>


        <section class="mt-12">

            <h2 class="text-3xl font-semibold text-center mb-8 text-teto-dark">
                Mengapa menggunakan TetoEdu?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div
                    class="bg-white rounded-lg shadow p-6 border-l-4 border-teto-accent">

                    <h5 class="text-xl font-semibold text-teto-dark">
                        Analisis Objektif</h5>
                    <p class="mt-3 text-teto-dark-text-soft">

                        Sistem rekomendasi kami menggunakan metode Simple
                        Additive Weighting (SAW) yang terukur dan objektif untuk
                        menganalisis kesesuaian kamu dengan berbagai jurusan
                        kuliah berdasarkan nilai akademik dan preferensimu.
                    </p>
                </div>
                <div
                    class="bg-white rounded-lg shadow p-6 border-l-4 border-teto-accent">

                    <h5 class="text-xl font-semibold text-teto-dark">
                        Rekomendasi Personal</h5>
                    <p class="mt-3 text-teto-dark-text-soft">

                        Kami tidak hanya melihat nilai, tetapi juga
                        mempertimbangkan bobot prioritas yang kamu tentukan
                        untuk setiap kriteria (mata pelajaran) untuk memberikan
                        rekomendasi jurusan yang benar-benar sesuai dengan
                        potensimu.
                    </p>
                </div>
                <div
                    class="bg-white rounded-lg shadow p-6 border-l-4 border-teto-accent">

                    <h5 class="text-xl font-semibold text-teto-dark">
                        Informasi Pendukung</h5>
                    <p class="mt-3 text-teto-dark-text-soft">

                        Dapatkan gambaran mengenai jurusan-jurusan yang
                        direkomendasikan, termasuk deskripsi singkat dan potensi
                        relevansinya dengan pilihanmu. (Database lengkap
                        menyusul).
                    </p>
                </div>
            </div>
        </section>


        <section class="mt-12 py-10 bg-teto-cream-hover rounded-lg">

            <h2 class="text-3xl font-semibold text-center mb-8 text-teto-dark">
                Bagaimana TetoEdu Bekerja?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-6 text-center">

                <div class="flex flex-col items-center">
                    <div
                        class="w-16 h-16 rounded-full bg-teto-primary text-white flex items-center justify-center text-2xl font-bold mb-3">
                        1</div>
                    <h5 class="text-xl font-semibold text-teto-dark mb-2">
                        Input Data Nilai</h5>
                    <p class="text-teto-dark-text-soft">Masukkan
                        nilai mata pelajaran yang relevan (misal: Matematika, B.
                        Indonesia, B. Inggris, Fisika, Kimia, dll.) dan tentukan
                        bobot prioritas untuk setiap mata pelajaran.</p>
                </div>

                <div class="flex flex-col items-center">
                    <div
                        class="w-16 h-16 rounded-full bg-teto-primary text-white flex items-center justify-center text-2xl font-bold mb-3">
                        2</div>
                    <h5 class="text-xl font-semibold text-teto-dark mb-2">
                        Proses Analisis SAW</h5>
                    <p class="text-teto-dark-text-soft">Sistem
                        akan menormalisasi nilai Anda dan menghitung skor
                        preferensi untuk setiap jurusan berdasarkan nilai dan
                        bobot yang Anda berikan menggunakan metode SAW.</p>
                </div>

                <div class="flex flex-col items-center">
                    <div
                        class="w-16 h-16 rounded-full bg-teto-primary text-white flex items-center justify-center text-2xl font-bold mb-3">
                        3</div>
                    <h5 class="text-xl font-semibold text-teto-dark mb-2">
                        Dapatkan Rekomendasi</h5>
                    <p class="text-teto-dark-text-soft">Lihat
                        daftar jurusan yang paling sesuai untuk Anda, diurutkan
                        berdasarkan skor tertinggi hasil perhitungan SAW,
                        lengkap dengan nilai skornya.</p>
                </div>
            </div>
        </section>


        <section class="mt-12">
            <h2 class="text-3xl font-semibold text-center mb-8 text-teto-dark">
                TetoEdu dalam Angka</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-4xl font-bold text-teto-primary">
                        100+</div>
                    <div class="mt-2 text-teto-dark-text-muted">
                        Jurusan Tersedia</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-4xl font-bold text-teto-primary">
                        500+</div>
                    <div class="mt-2 text-teto-dark-text-muted">
                        Pengguna Terbantu</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-4xl font-bold text-teto-primary">
                        95%</div>
                    <div class="mt-2 text-teto-dark-text-muted">
                        Akurasi Relatif*</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-4xl font-bold text-teto-primary">
                        10+</div>
                    <div class="mt-2 text-teto-dark-text-muted">
                        Kriteria Penilaian</div>
                </div>
            </div>
            <p class="text-center text-sm text-teto-dark-text-muted mt-4">
                *Akurasi relatif berdasarkan kesesuaian input pengguna dengan
                standar jurusan umum.</p>
        </section>


        <section class="mt-12 py-10 bg-teto-cream rounded-lg">

            <h2 class="text-3xl font-semibold text-center mb-8 text-teto-dark">
                Apa Kata Mereka?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6">

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <img src="https://i.pinimg.com/736x/5c/01/78/5c0178c31a9c9191f548cc7599f32c4c.jpg"
                        alt="User Avatar"
                        class="w-20 h-20 rounded-full mx-auto mb-4 border-2 border-teto-soft-blue">

                    <p class="text-teto-dark-text-soft italic mb-4">
                        "Sangat membantu! Tadinya bingung mau pilih jurusan apa
                        antara Teknik Informatika dan Sistem Informasi, setelah
                        pakai TetoEdu, jadi lebih yakin."</p>
                    <h6 class="font-semibold text-teto-dark">Andi
                        P.</h6>
                    <p class="text-sm text-teto-dark-text-muted">
                        Siswa SMA</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <img src="https://i.pinimg.com/736x/5c/01/78/5c0178c31a9c9191f548cc7599f32c4c.jpg"
                        alt="User Avatar"
                        class="w-20 h-20 rounded-full mx-auto mb-4 border-2 border-teto-pastel-pink">

                    <p class="text-teto-dark-text-soft italic mb-4">
                        "Metode SAW-nya keren, jadi bisa prioritasin nilai
                        Fisika dan Matematika yang memang saya unggulkan. Hasil
                        rekomendasinya masuk akal."</p>
                    <h6 class="font-semibold text-teto-dark">
                        Citra L.</h6>
                    <p class="text-sm text-teto-dark-text-muted">
                        Kelas 12 IPA</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <img src="https://i.pinimg.com/736x/5c/01/78/5c0178c31a9c9191f548cc7599f32c4c.jpg"
                        alt="User Avatar"
                        class="w-20 h-20 rounded-full mx-auto mb-4 border-2 border-teto-soft-teal">

                    <p class="text-teto-dark-text-soft italic mb-4">
                        "Mudah digunakan dan langsung dapat hasilnya. Tidak
                        perlu pusing-pusing hitung manual lagi."</p>
                    <h6 class="font-semibold text-teto-dark">Budi
                        S.</h6>
                    <p class="text-sm text-teto-dark-text-muted">
                        Calon Mahasiswa</p>
                </div>
            </div>
        </section>


        <section class="mt-12">
            <h2 class="text-3xl font-semibold text-center mb-8 text-teto-dark">
                Jurusan Populer di Sistem Kami</h2>
            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Teknik
                        Informatika</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Manajemen</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Kedokteran</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Akuntansi</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Ilmu
                        Komunikasi</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Teknik
                        Sipil</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Psikologi</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Hukum</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Desain
                        Komunikasi Visual</span>
                </div>
                <div
                    class="bg-teto-light text-center p-4 rounded-lg shadow hover:shadow-md transition-shadow">
                    <span class="font-medium text-teto-cream">Farmasi</span>
                </div>

            </div>
        </section>


        <section class="mt-12 mb-12">
            <h2 class="text-3xl font-semibold text-center mb-8 text-teto-dark">
                Pertanyaan yang Sering Diajukan (FAQ)</h2>
            <div class="max-w-3xl mx-auto space-y-4">

                <details class="bg-white p-4 rounded-lg shadow group" open>

                    <summary
                        class="font-semibold text-teto-dark cursor-pointer list-none flex justify-between items-center">
                        <span>Bagaimana cara kerja penentuan bobot
                            prioritas?</span>
                        <span
                            class="text-teto-primary transform transition-transform duration-300 group-open:rotate-180">▼</span>
                    </summary>
                    <p class="mt-3 text-teto-dark-text-soft">
                        Anda memberikan nilai bobot (misalnya dari 1 sampai 5)
                        untuk setiap mata pelajaran sesuai dengan seberapa
                        penting menurut Anda mata pelajaran tersebut untuk
                        jurusan yang Anda minati. Bobot yang lebih tinggi
                        berarti mata pelajaran itu lebih diprioritaskan dalam
                        perhitungan.
                    </p>
                </details>

                <details class="bg-white p-4 rounded-lg shadow group">
                    <summary
                        class="font-semibold text-teto-dark cursor-pointer list-none flex justify-between items-center">
                        <span>Apakah data nilai saya aman?</span>
                        <span
                            class="text-teto-primary transform transition-transform duration-300 group-open:rotate-180">▼</span>
                    </summary>
                    <p class="mt-3 text-teto-dark-text-soft">
                        Ya, kami menghargai privasi Anda. Data nilai yang Anda
                        masukkan hanya digunakan untuk proses perhitungan
                        rekomendasi di sesi Anda saat ini dan tidak disimpan
                        secara permanen terkait identitas pribadi Anda tanpa
                        izin eksplisit (misalnya jika Anda membuat akun).
                    </p>
                </details>

                <details class="bg-white p-4 rounded-lg shadow group">
                    <summary
                        class="font-semibold text-teto-dark cursor-pointer list-none flex justify-between items-center">
                        <span>Apakah hasil rekomendasi ini 100% akurat?</span>
                        <span
                            class="text-teto-primary transform transition-transform duration-300 group-open:rotate-180">▼</span>
                    </summary>
                    <p class="mt-3 text-teto-dark-text-soft">
                        Sistem ini adalah alat bantu (decision support system)
                        yang memberikan rekomendasi berdasarkan data kuantitatif
                        (nilai dan bobot). Keputusan akhir tetap ada pada Anda.
                        Pertimbangkan juga faktor lain seperti minat mendalam,
                        prospek karir, biaya kuliah, dan lokasi universitas.
                    </p>
                </details>

                <details class="bg-white p-4 rounded-lg shadow group">
                    <summary
                        class="font-semibold text-teto-dark cursor-pointer list-none flex justify-between items-center">
                        <span>Bisakah saya mencoba dengan kombinasi nilai dan
                            bobot yang berbeda?</span>
                        <span
                            class="text-teto-primary transform transition-transform duration-300 group-open:rotate-180">▼</span>
                    </summary>
                    <p class="mt-3 text-teto-dark-text-soft">
                        Tentu saja! Anda bisa melakukan simulasi beberapa kali
                        dengan memasukkan nilai atau mengubah bobot prioritas
                        untuk melihat bagaimana perubahan tersebut mempengaruhi
                        hasil rekomendasi jurusan.
                    </p>
                </details>
            </div>
        </section>
    </div>

    <x-footer />

</x-app>

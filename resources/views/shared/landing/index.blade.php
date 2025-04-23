<x-base-layout title="Home">
    <header class=" bg-slate-300">
        <nav class="flex items-center justify-between px-12 py-4 mx-auto ">
            <a href="{{ route('home') }}" class=" bold text-2xl">Logo dan nama
                app</a>
            <div class=" flex items-center gap-8">
                <div class=" flex gap-4 items-center">
                    <a href="#"
                        class="font-medium cursor-pointer hover:underline underline-offset-4">
                        About Us
                    </a>
                    <a href="#"
                        class="font-medium cursor-pointer hover:underline underline-offset-4">
                        FAQ
                    </a>
                    <a href="#"
                        class="font-medium cursor-pointer hover:underline underline-offset-4">
                        Contact
                    </a>
                </div>
                @auth
                    <div class="flex items-center gap-2">
                        <a href="{{ route('profile.index') }}"
                            class="font-medium cursor-pointer hover:underline underline-offset-4">
                            Profile
                        </a>
                    </div>
                @else
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('login') }}"
                            class="font-medium cursor-pointer hover:underline underline-offset-4">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="font-medium cursor-pointer hover:underline underline-offset-4">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </nav>
    </header>

    @php
        $alertTypes = ['success', 'error', 'warning', 'info'];
    @endphp

    @foreach ($alertTypes as $type)
        @switch(true)
            @case(session()->has($type))
                <x-alert type="{{ $type }}">
                    {{ session($type) }}
                </x-alert>
            @break
        @endswitch
    @endforeach

    <div class="container px-4 py-2 mx-auto">
        <section class=" bg-slate-300 rounded-md p-16">
            <h1 class=" text-5xl font-medium">Temukan Jurusan Kuliah Yang Tepat
                Untuk Masa
                Depanmu</h1>
            <p class=" mt-4">Sistem rekomendasi jurusan kuliah berbasis
                kecerdasan buatan yang
                membantu kamu menemukan jurusan terbaik sesuai minat, bakat, dan
                kemampuan akademismu.
            </p>
            <div class=" flex justify-center items-center">
                <a href="{{ route('login') }}"
                    class=" text-2xl inline-flex items-center justify-center px-8 py-4 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-slate-700 text-white hover:bg-slate-800 focus:ring-slate-500 mt-4">
                    Mulai Sekarang
                </a>
            </div>
        </section>

        <section class=" mt-4">
            <h3 class=" text-2xl font-medium">Mengapa menggunakan nama website?
            </h3>

            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class=" bg-slate-200 rounded py-2 px-4">
                    <h5 class=" font-medium">Analisis Berbasis Data</h5>
                    <p class=" mt-2">Sistem rekomendasi kami menggunakan metode
                        Simple
                        Additive
                        Weighting (SAW) yang terukur dan objektif untuk
                        menganalisis
                        kesesuaian kamu dengan berbagai jurusan kuliah.
                    </p>
                </div>
                <div class=" bg-slate-200 rounded py-2 px-4">
                    <h5 class=" font-medium">Rekomendasi Personal</h5>
                    <p class=" mt-2">Kami tidak hanya melihat nilai akademis,
                        tetapi juga mempertimbangkan minat, bakat, dan
                        karakteristik pribadi untuk memberikan rekomendasi
                        jurusan yang benar-benar sesuai dengan dirimu.
                    </p>
                </div>
                <div class=" bg-slate-200 rounded py-2 px-4">
                    <h5 class=" font-medium">Database Lengkap</h5>
                    <p class=" mt-2">Akses informasi lengkap mengenai berbagai
                        jurusan kuliah, prospek karir, dan universitas terbaik
                        yang menawarkan program studi tersebut.
                    </p>
                </div>
            </div>
        </section>

        <section class=" mt-4">
            <h3 class=" text-2xl font-medium">Bagaimana nama website Bekerja?

        </section>

        <section class=" mt-4">
            <h3 class=" text-2xl font-medium">JurusanKu dalam Angka

        </section>

        <section class=" mt-4">
            <h3 class=" text-2xl font-medium">Apa Kata Mereka?

        </section>

        <section class=" mt-4">
            <h3 class=" text-2xl font-medium">Jurusan Populer Tahun Ini

        </section>

        <section class=" mt-4">
            <h3 class=" text-2xl font-medium">Pertanyaan yang Sering Diajukan

        </section>
    </div>
</x-base-layout>

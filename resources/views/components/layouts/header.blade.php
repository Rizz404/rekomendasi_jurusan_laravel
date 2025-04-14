<header class=" bg-slate-300">
    <nav class="flex items-center justify-between px-12 py-4 mx-auto ">
        <div class="flex items-center gap-4 ">
            <a href="{{ route('home') }}"
                class="font-medium cursor-pointer hover:underline underline-offset-4">
                Home
            </a>
            <a href="{{ route('criterias.index') }}"
                class="font-medium cursor-pointer hover:underline underline-offset-4">
                Kriteria
            </a>
            <a href="{{ route('college-majors.index') }}"
                class="font-medium cursor-pointer hover:underline underline-offset-4">
                Jurusan Kuliah
            </a>
            <a href="{{ route('home') }}"
                class="font-medium cursor-pointer hover:underline underline-offset-4">
                Kriteria Jurusan
            </a>
            <a href="{{ route('student-scores.index') }}"
                class="font-medium cursor-pointer hover:underline underline-offset-4">
                Kalkulasi nilai
            </a>
        </div>
        @auth
            <div class="flex items-center gap-2">
                <a href="{{ route('profile') }}"
                    class="text-sm font-light ">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="">
                    @csrf

                    <button type="submit"
                        class="text-sm font-light cursor-pointer">
                        logout
                    </button>
                </form>
            </div>
        @else
            <div class="flex gap-2 ">
                <a href="{{ route('login') }}" class="text-sm font-light ">Login</a>
                <a href="{{ route('register') }}"
                    class="text-sm font-light ">Register</a>
            </div>
        @endauth
    </nav>
</header>

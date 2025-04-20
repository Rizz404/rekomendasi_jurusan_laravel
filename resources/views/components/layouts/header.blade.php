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
                    <a href="{{ route('profile') }}"
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

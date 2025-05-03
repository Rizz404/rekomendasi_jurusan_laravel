<header
    class="bg-gradient-to-r from-teto-dark to-teto-light text-white shadow-md">
    <nav class="flex items-center justify-between px-4 md:px-12 py-4 mx-auto">
        <a href="{{ route('home') }}" class="bold text-2xl flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
            </svg>
            <span class="font-sans">...</span>
        </a>
        <div class="flex items-center gap-4 md:gap-8">
            <div class="flex gap-4 items-center">
                <a href="#"
                    class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-college-majors.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                    About Us
                </a>
                <a href="#"
                    class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-college-majors.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                    FAQ
                </a>
                <a href="#"
                    class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-college-majors.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                    Contact
                </a>
            </div>
            @auth
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile.index') }}"
                        class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('profile.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </div>
            @else
                <div class="flex gap-2 items-center">
                    <a href="{{ route('login') }}"
                        class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('login') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-teto-dark text-white px-3 py-1 rounded font-sans font-medium cursor-pointer hover:bg-teto-light flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                        <span>Register</span>
                    </a>
                </div>
            @endauth
        </div>
    </nav>
</header>

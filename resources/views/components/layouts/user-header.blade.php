<header
    class="bg-gradient-to-r from-teto-dark to-teto-light text-white shadow-md">
    <nav class="flex items-center justify-between px-4 md:px-12 py-4 mx-auto">
        <a href="{{ route('home') }}" class="bold text-2xl flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
            </svg>
            <span class="font-sans">Logo dan nama app</span>
        </a>
        <div class="flex items-center gap-4 md:gap-8">
            <div class="flex gap-4 items-center">
                <a href="{{ route('my-college-majors.index') }}"
                    class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-college-majors.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                        <path
                            d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762z" />
                        <path
                            d="M9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z" />
                    </svg>
                    <span>College Majors</span>
                </a>
                <a href="{{ route('my-universities.index') }}"
                    class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-universities.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1v1h-1v-1H6v1H5v-1a1 1 0 01-1-1V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Universities</span>
                </a>
                <a href="{{ route('my-grades.index') }}"
                    class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-grades.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>My Grades</span>
                </a>
                <a href="{{ route('my-recommendations.index') }}"
                    class="font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-recommendations.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                        <path
                            d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                    </svg>
                    <span>My Recommendation</span>
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

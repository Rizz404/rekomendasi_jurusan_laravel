<header
    class="bg-gradient-to-r from-teto-dark to-teto-light text-white shadow-md">
    <div class="flex items-center justify-between px-4 md:px-8 py-5 mx-auto">
        <div class="flex md:hidden">
            <button id="mobile-menu-button" type="button"
                class="text-slate-200 hover:text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="flex-1 flex justify-center md:justify-start">
            <a href="{{ route('admin.dashboard.index') }}"
                class="bold text-2xl flex items-center text-teto-cream">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                </svg>
                <span class="hidden md:block">...</span>
            </a>
        </div>

        <div class="relative ml-3">
            <div>
                <a href="{{ route('profile.index') }}" id="user-menu-button"
                    class="flex items-center rounded-full bg-slate-700 text-sm focus:outline-none">
                    <img class="h-8 w-8 rounded-full"
                        src="https://ui-avatars.com/api/?name=Admin+User&background=0284c7&color=fff"
                        alt="Profile">
                </a>
            </div>
        </div>
    </div>
</header>

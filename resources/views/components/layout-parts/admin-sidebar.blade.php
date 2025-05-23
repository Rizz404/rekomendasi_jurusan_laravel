<div class="hidden md:flex md:w-64 md:flex-col">
    <div
        class="flex flex-col flex-grow pt-4 overflow-y-auto bg-teto-dark shadow-lg">
        <div class="flex items-center flex-shrink-0 px-4">
            <a href="{{ route('admin.dashboard.index') }}"
                class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 text-teto-cream mr-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                </svg>
                <span class="text-xl font-bold text-teto-cream font-sans">Admin
                    Panel</span>
            </a>
        </div>

        <nav class="flex-1 mt-6 px-2 space-y-1">
            {{-- * Dashboard --}}
            <a href="{{ route('admin.dashboard.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard.index') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard.index') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                </svg>
                Dashboard
            </a>

            {{-- * User & Siswa --}}
            <a href="{{ route('admin.users.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.users*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mr-3 h-5 w-5 {{ request()->routeIs('admin.users*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
                User & Siswa
            </a>

            {{-- * Criterias --}}
            <a href="{{ route('admin.criterias.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.criterias*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mr-3 h-5 w-5 {{ request()->routeIs('admin.criterias*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                        clip-rule="evenodd" />
                </svg>
                Kriteria
            </a>

            {{-- * College Majors --}}
            <a href="{{ route('admin.college-majors.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.college-majors*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mr-3 h-5 w-5 {{ request()->routeIs('admin.college-majors*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                    <path
                        d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zm6.72 7.096a9.06 9.06 0 002.92-1.138v-3.956l-1.818.778a3 3 0 01-2.364 0l-5.508-2.361a11.02 11.02 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 005.35 2.524 1 1 0 01.04.004zM15 11.73V7.72l-5.591 2.396a3 3 0 01-2.37.01l-5.755-2.45-.035.29a1 1 0 00.595 1.141L7.5 10.825v4.365c.18-.004.358-.014.536-.025l8.464-3.434z" />
                </svg>
                Jurusan Kuliah
            </a>

            {{-- * Major Characteristics --}}
            <a href="{{ route('admin.major-characteristics.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.major-characteristics*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mr-3 h-5 w-5 {{ request()->routeIs('admin.major-characteristics*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                        clip-rule="evenodd" />
                </svg>
                Karakteristik Jurusan
            </a>

            {{-- * Student Scores --}}
            <a href="{{ route('admin.student-scores.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.student-scores*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mr-3 h-5 w-5 {{ request()->routeIs('admin.student-scores*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                </svg>
                Nilai Siswa
            </a>

            {{-- * Universities --}}
            <a href="{{ route('admin.universities.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.universities*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor"
                    class="mr-3 h-5 w-5 {{ request()->routeIs('admin.universities*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}">
                    <path d="M10 1L1 5l9 4 9-4-9-4z" />
                    <path
                        d="M3 7v6h2v-6H3zm4 0v6h2v-6H7zm4 0v6h2v-6h-2zm4 0v6h2v-6h-2z" />
                    <path d="M2 14h16v2a1 1 0 01-1 1H3a1 1 0 01-1-1v-2z" />
                    <path d="M1 6v7h1V6H1zm17 0v7h1V6h-1z" />
                </svg>
                Universitas
            </a>
        </nav>

        <div class="flex-shrink-0 flex border-t border-teto-dark-active p-4">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="group flex items-center px-4 py-2 text-sm font-medium rounded-md text-teto-cream hover:bg-teto-primary hover:text-teto-cream w-full transition duration-150 ease-in-out cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="mr-3 h-5 w-5 text-teto-pastel-pink group-hover:text-teto-cream"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                            clip-rule="evenodd" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

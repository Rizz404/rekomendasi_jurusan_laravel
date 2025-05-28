<div x-cloak
    class="fixed inset-y-0 left-0 z-40 w-64 bg-teto-dark shadow-lg transform"
    x-show="sidebarOpen" @keydown.escape.window="sidebarOpen = false"
    @click.away="sidebarOpen = false" {{-- Closes sidebar if clicked outside, on any screen size --}}
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full">
    <div class="flex flex-col flex-grow h-full">
        <div class="flex items-center flex-shrink-0 px-4 pt-4">
            <a href="{{ route('admin.dashboard.index') }}"
                class="flex items-center">
                <span class="text-xl font-bold text-teto-cream font-sans">Admin
                    Panel</span>
            </a>
            <button @click="sidebarOpen = false"
                class="ml-auto lg:hidden text-teto-cream hover:text-teto-accent focus:outline-none"
                {{-- Hidden on lg and up --}} aria-label="Close sidebar">
                <i class="fas fa-times fa-lg"></i>
            </button>
        </div>

        <nav class="flex-1 mt-6 px-2 space-y-1 overflow-y-auto pb-4">
            {{-- * Dashboard --}}
            <a href="{{ route('admin.dashboard.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard.index') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <i
                    class="fas fa-tachometer-alt mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard.index') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"></i>
                Dashboard
            </a>
            {{-- (Nav items lainnya tetap sama) --}}
            {{-- * User & Siswa --}}
            <a href="{{ route('admin.users.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.users*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <i
                    class="fas fa-users mr-3 h-5 w-5 {{ request()->routeIs('admin.users*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"></i>
                User & Siswa
            </a>
            {{-- * Criterias --}}
            <a href="{{ route('admin.criterias.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.criterias*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <i
                    class="fas fa-list-alt mr-3 h-5 w-5 {{ request()->routeIs('admin.criterias*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"></i>
                Kriteria
            </a>
            {{-- * College Majors --}}
            <a href="{{ route('admin.college-majors.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.college-majors*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <i
                    class="fas fa-book-open mr-3 h-5 w-5 {{ request()->routeIs('admin.college-majors*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"></i>
                Jurusan Kuliah
            </a>
            {{-- * Major Characteristics --}}
            <a href="{{ route('admin.major-characteristics.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.major-characteristics*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <i
                    class="fas fa-bolt mr-3 h-5 w-5 {{ request()->routeIs('admin.major-characteristics*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"></i>
                Karakteristik Jurusan
            </a>
            {{-- * Student Scores --}}
            <a href="{{ route('admin.student-scores.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.student-scores*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <i
                    class="fas fa-chart-bar mr-3 h-5 w-5 {{ request()->routeIs('admin.student-scores*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"></i>
                Nilai Siswa
            </a>
            {{-- * Universities --}}
            <a href="{{ route('admin.universities.index') }}"
                class="group flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.universities*') ? 'bg-teto-primary-active text-teto-cream' : 'text-teto-cream hover:bg-teto-primary-active hover:text-teto-cream' }}">
                <i
                    class="fas fa-university mr-3 h-5 w-5 {{ request()->routeIs('admin.universities*') ? 'text-teto-accent' : 'text-teto-pastel-pink group-hover:text-teto-accent' }}"></i>
                Universitas
            </a>
        </nav>

        <div class="flex-shrink-0 mt-auto border-t border-teto-dark-active p-4">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="group flex items-center px-4 py-2 text-sm font-medium rounded-md text-teto-cream hover:bg-teto-primary hover:text-teto-cream w-full transition duration-150 ease-in-out cursor-pointer">
                    <i
                        class="fas fa-sign-out-alt mr-3 h-5 w-5 text-teto-pastel-pink group-hover:text-teto-cream"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

<header
    class="bg-gradient-to-r from-teto-dark to-teto-light text-white shadow-md">
    <div class="flex items-center justify-between px-4 md:px-8 py-5 mx-auto">
        <div class="flex">
            <button @click="sidebarOpen = !sidebarOpen" type="button"
                class="text-slate-200 hover:text-white focus:outline-none"
                aria-label="Toggle sidebar">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        </div>

        <div class="flex-1 flex justify-center md:justify-start ml-4">
            {{-- Added ml-4 for spacing from new button --}}
            <a href="{{ route('admin.dashboard.index') }}"
                class="bold text-2xl flex items-center text-teto-cream">
                <span class="hidden md:block">Admin Panel</span>
            </a>
        </div>

        <div class="relative ml-3">
            <div>
                @php
                    $user = Auth::user();
                    $profilePicture = $user->profile_picture ?? null;
                @endphp
                <a href="{{ route('profile.index') }}"
                    class="font-sans font-medium cursor-pointer hover:text-teto-dark-text-muted {{ request()->routeIs('profile.index') ? ' text-teto-accent-active' : ' text-teto-dark-text' }} transition-colors duration-300 ease-in-out flex items-center">
                    @if ($profilePicture)
                        <img src="{{ $profilePicture }}"
                            alt="{{ $user->username }}'s profile picture"
                            class="h-8 w-8 rounded-full object-cover">
                    @else
                        <i class="fas fa-user-circle fa-2x text-teto-cream"></i>
                    @endif
                </a>
            </div>
        </div>
    </div>
</header>

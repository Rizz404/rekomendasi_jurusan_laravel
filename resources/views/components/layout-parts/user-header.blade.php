<header
    class="text-white shadow-md bg-gradient-to-r from-teto-dark to-teto-light"
    x-data="{ mobileMenuOpen: false }">
    <nav class="flex items-center justify-between px-4 py-4 mx-auto md:px-12">


        <a href="{{ route('home') }}"
            class="items-center justify-center hidden gap-2 text-2xl font-bold md:flex">
            <i
                class="flex items-center justify-center w-8 h-8 fas fa-graduation-cap"></i>
            <span class="font-sans leading-none">TetoEdu</span>
        </a>


        <button type="button"
            class="flex items-center justify-center gap-2 text-2xl font-bold md:hidden">
            <i class="flex items-center justify-center w-8 h-8 cursor-pointer fas fa-bars"
                @click="mobileMenuOpen = !mobileMenuOpen"></i>
            <span class="font-sans leading-none">TetoEdu</span>
        </button>

        <div class="flex items-center gap-4 md:gap-8">

            <div class="items-center hidden gap-4 md:flex">
                <a href="{{ route('my-college-majors.index') }}"
                    class="flex items-center font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-college-majors.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out">
                    <i class="mr-2 fas fa-graduation-cap"></i>
                    <span>College Majors</span>
                </a>
                <a href="{{ route('my-universities.index') }}"
                    class="flex items-center font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-universities.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out">
                    <i class="mr-2 fas fa-university"></i>
                    <span>Universities</span>
                </a>
                <a href="{{ route('my-grades.index') }}"
                    class="flex items-center font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-grades.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out">
                    <i class="mr-2 fas fa-chart-line"></i>
                    <span>My Grades</span>
                </a>
                <a href="{{ route('my-recommendations.index') }}"
                    class="flex items-center font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-recommendations.index') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out">
                    <i class="mr-2 fas fa-comments"></i>
                    <span>My Recommendation</span>
                </a>
            </div>

            @auth
                @php
                    $user = Auth::user();
                    $profilePicture = $user->profile_picture;
                @endphp
                <a href="{{ route('profile.index') }}"
                    class="flex items-center font-sans font-medium cursor-pointer hover:text-teto-dark-text-muted {{ request()->routeIs('profile.index') ? ' text-teto-accent-active' : ' text-teto-dark-text' }} transition-colors duration-300 ease-in-out">
                    @if ($profilePicture)
                        <img src="{{ $profilePicture }}"
                            alt="{{ $user->username }}'s profile picture"
                            class="object-cover w-8 h-8 rounded-full">
                    @else
                        <i class="text-2xl fas fa-user-circle"></i>
                    @endif
                </a>
            @else
                <div class="flex items-center gap-2">
                    <a href="{{ route('login') }}"
                        class="flex items-center font-sans font-medium cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('login') ? ' text-teto-accent-active' : ' text-white' }} transition-colors duration-300 ease-in-out">
                        <i class="mr-2 fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}"
                        class="flex items-center px-3 py-1 font-sans font-medium text-white rounded cursor-pointer bg-teto-dark hover:bg-teto-light">
                        <i class="mr-2 fas fa-user-plus"></i>
                        <span>Register</span>
                    </a>
                </div>
            @endauth
        </div>
    </nav>


    <div x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2"
        @click.away="mobileMenuOpen = false"
        class="border-t md:hidden bg-teto-dark border-teto-light/30">
        <div class="px-4 py-4 space-y-2">

            <a href="{{ route('my-college-majors.index') }}"
                class="flex items-center px-2 py-3 font-sans font-medium rounded cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-college-majors.index') ? ' text-teto-accent-active bg-teto-light/20' : ' text-white' }} transition-colors duration-300 ease-in-out">
                <i class="w-5 mr-3 fas fa-graduation-cap"></i>
                <span>College Majors</span>
            </a>
            <a href="{{ route('my-universities.index') }}"
                class="flex items-center px-2 py-3 font-sans font-medium rounded cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-universities.index') ? ' text-teto-accent-active bg-teto-light/20' : ' text-white' }} transition-colors duration-300 ease-in-out">
                <i class="w-5 mr-3 fas fa-university"></i>
                <span>Universities</span>
            </a>
            <a href="{{ route('my-grades.index') }}"
                class="flex items-center px-2 py-3 font-sans font-medium rounded cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-grades.index') ? ' text-teto-accent-active bg-teto-light/20' : ' text-white' }} transition-colors duration-300 ease-in-out">
                <i class="w-5 mr-3 fas fa-chart-line"></i>
                <span>My Grades</span>
            </a>
            <a href="{{ route('my-recommendations.index') }}"
                class="flex items-center px-2 py-3 font-sans font-medium rounded cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('my-recommendations.index') ? ' text-teto-accent-active bg-teto-light/20' : ' text-white' }} transition-colors duration-300 ease-in-out">
                <i class="w-5 mr-3 fas fa-comments"></i>
                <span>My Recommendation</span>
            </a>

            @auth
                @php
                    $user = Auth::user();
                    $profilePicture = $user->profile_picture;
                @endphp
                <div class="pt-4 mt-4 border-t border-teto-light/30">
                    <a href="{{ route('profile.index') }}"
                        class="flex items-center px-2 py-3 font-sans font-medium rounded cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('profile.index') ? ' text-teto-accent-active bg-teto-light/20' : ' text-white' }} transition-colors duration-300 ease-in-out">
                        @if ($profilePicture)
                            <img src="{{ $profilePicture }}"
                                alt="{{ $user->username }}'s profile picture"
                                class="object-cover w-6 h-6 mr-3 rounded-full">
                        @else
                            <i class="w-5 mr-3 fas fa-user-circle"></i>
                        @endif
                        <span>Profile ({{ $user->username }})</span>
                    </a>
                </div>
            @else
                <div class="pt-4 mt-4 space-y-2 border-t border-teto-light/30">
                    <a href="{{ route('login') }}"
                        class="flex items-center px-2 py-3 font-sans font-medium rounded cursor-pointer hover:text-teto-accent-hover {{ request()->routeIs('login') ? ' text-teto-accent-active bg-teto-light/20' : ' text-white' }} transition-colors duration-300 ease-in-out">
                        <i class="w-5 mr-3 fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center px-4 py-3 font-sans font-medium transition-colors duration-300 rounded cursor-pointer bg-teto-accent text-teto-dark-text hover:bg-teto-accent-hover">
                        <i class="mr-2 fas fa-user-plus"></i>
                        <span>Register</span>
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>

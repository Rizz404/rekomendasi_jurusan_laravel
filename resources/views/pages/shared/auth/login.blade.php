<x-app title="Login">
    <div
        class="flex items-center justify-center min-h-screen py-12 bg-gradient-to-br from-teto-dark to-teto-primary sm:px-4 lg:px-8">
        <div class="mt-8 w-full max-w-sm mx-auto sm:max-w-md">
            <div
                class="px-6 py-8 bg-white/90 shadow-lg rounded-lg sm:px-10 backdrop-blur-sm border border-teto-light/30">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-teto-primary">Welcome
                        Back!</h2>
                    <p class="text-teto-dark-text-muted">Log in to your account
                    </p>
                </div>

                <form class="flex flex-col gap-4" action="{{ route('login') }}"
                    method="POST">
                    @csrf

                    <x-ui.input label="Email address" name="email"
                        type="email" placeholder="Input your email" required
                        autocomplete="email" />

                    <x-ui.input label="Password" name="password" type="password"
                        placeholder="Input your password" required
                        autocomplete="current-password" />

                    <div class="flex justify-between items-center">
                        <x-ui.input type="hidden" name="remember"
                            value="0" />
                        <x-ui.checkbox name="remember" label="Remember me"
                            class="text-teto-primary" />
                        {{-- <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-teto-dark hover:text-teto-primary transition">
                            Forgot password?
                        </a> --}}
                    </div>

                    <div class="flex items-center justify-center gap-2 mt-2">
                        <span class="text-sm text-teto-dark-text-muted">Don't
                            have an account?</span>
                        <a href="{{ route('register') }}"
                            class="text-sm font-semibold text-teto-primary hover:text-teto-dark transition">
                            Register now
                        </a>
                    </div>

                    <x-ui.button type="submit"
                        class="w-full py-2.5 bg-teto-primary hover:bg-teto-primary-hover active:bg-teto-primary-active text-white font-medium rounded-md transition-colors">
                        Login
                    </x-ui.button>
                </form>
            </div>
        </div>
    </div>
</x-app>

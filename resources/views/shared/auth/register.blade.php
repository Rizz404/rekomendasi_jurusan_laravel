<x-base-layout title="Register">
    <div
        class="flex flex-col justify-center min-h-screen py-12 bg-gray-100 sm:px-6 lg:px-8">
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form class="flex flex-col gap-4 "
                    action="{{ route('register') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <x-input label="Username" name="username" type="text"
                        placeholder="Input your username" required />
                    <x-input label="Email address" name="email" type="email"
                        placeholder="Input your email" required
                        autocomplete="email" />
                    <x-input label="Password" name="password" type="password"
                        placeholder="Input your password" required
                        autocomplete="current-password" />
                    <x-input label="Confirm Password"
                        name="password_confirmation" type="password"
                        placeholder="Input your confirm password" required />

                    <p class="mt-2 text-sm text-gray-600 text-end">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-medium text-slate-600 hover:text-slate-500">
                            Login
                        </a>
                    </p>

                    <x-button type="submit">Register</x-button>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>

<x-base-layout title="Login">
    <div
        class="flex items-center justify-center min-h-screen py-12 bg-slate-100 sm:px-6 lg:px-8">
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form class="flex flex-col gap-4"
                    action="{{ route('auth.login') }}" method="POST">
                    @csrf


                    <x-input label="Email address" name="email" type="email"
                        placeholder="Input your email" required
                        autocomplete="email" />
                    <x-input label="Password" name="password" type="password"
                        placeholder="Input your password" required
                        autocomplete="current-password" />

                    <p class="mt-2 text-sm text-slate-600 text-end">
                        Dont have account ?
                        <a href="{{ route('auth.register') }}"
                            class="font-medium text-slate-600 hover:text-slate-500">
                            register
                        </a>
                    </p>

                    <div>
                        <button type="submit"
                            class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-slate-600 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>

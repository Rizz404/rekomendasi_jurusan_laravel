@props(['title' => ''])

<x-app title="{{ $title }}">
    <div class="flex h-screen bg-teto-cream-active" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">
        <div x-show="sidebarOpen && window.innerWidth < 1024"
            @click="sidebarOpen = false" class="fixed inset-0 z-30 lg:hidden"
            x-cloak>
            <div class="absolute inset-0 bg-gray-900 bg-opacity-25 backdrop-blur-sm"
                x-transition:enter="transition-opacity ease-linear duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
            </div>
        </div>

        <x-admin-sidebar />

        <div class="flex flex-col flex-1 overflow-hidden transition-all duration-300 ease-in-out"
            :class="{ 'lg:ml-64': sidebarOpen, 'lg:ml-0': !sidebarOpen }">
            <x-admin-header />

            <div class="fixed top-0 left-0 z-50 w-full pointer-events-none p-4">
                @php
                    $alertTypes = ['success', 'error', 'warning', 'info'];
                @endphp
                @foreach ($alertTypes as $type)
                    @if (session()->has($type))
                        <div class="pointer-events-auto">
                            <x-ui.alert type="{{ $type }}">
                                {{ session($type) }}
                            </x-ui.alert>
                        </div>
                    @endif
                @endforeach
            </div>

            <main
                class="flex-1 relative overflow-y-auto focus:outline-none p-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-app>

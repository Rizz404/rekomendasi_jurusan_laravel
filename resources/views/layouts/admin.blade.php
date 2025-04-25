@props(['title' => ''])

<x-base-layout title="{{ $title }}">
    <div class="flex h-screen bg-gray-100">
        <x-admin-sidebar />

        {{-- * Main Content --}}
        <div class="flex flex-col flex-1 overflow-hidden">
            <x-layouts.admin-header />

            {{-- * Alert Messages --}}
            <div class="px-4 py-2">
                @php
                    $alertTypes = ['success', 'error', 'warning', 'info'];
                @endphp

                @foreach ($alertTypes as $type)
                    @switch(true)
                        @case(session()->has($type))
                            <x-alert type="{{ $type }}">
                                {{ session($type) }}
                            </x-alert>
                        @break
                    @endswitch
                @endforeach
            </div>

            {{-- * Main Content Area --}}
            <main
                class="flex-1 relative overflow-y-auto focus:outline-none p-4 bg-gray-100">
                {{ $slot }}
            </main>
            <x-layouts.footer />
        </div>
    </div>
</x-base-layout>

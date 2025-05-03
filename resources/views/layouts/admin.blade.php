@props(['title' => ''])

<x-base-layout title="{{ $title }}">
    <div class="flex h-screen bg-gray-100">
        <x-admin-sidebar />

        {{-- * Konten Utama --}}
        <div class="flex flex-col flex-1 overflow-hidden">
            <x-layouts.admin-header />

            {{-- * Kontainer alert dengan posisi tetap --}}
            <div class="fixed top-0 left-0 z-50 w-full pointer-events-none p-4">
                @php
                    $alertTypes = ['success', 'error', 'warning', 'info'];
                @endphp

                @foreach ($alertTypes as $type)
                    @if (session()->has($type))
                        <div class="pointer-events-auto">
                            <x-alert type="{{ $type }}">
                                {{ session($type) }}
                            </x-alert>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- * Area Konten Utama --}}
            <main
                class="flex-1 relative overflow-y-auto focus:outline-none p-4 bg-gray-100">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-base-layout>

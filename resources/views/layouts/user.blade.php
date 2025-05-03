@props(['title' => ''])

{{-- * Passing props dari base layout --}}
<x-base-layout title="{{ $title }}">
    <x-layouts.user-header />

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

    {{ $slot }}
</x-base-layout>

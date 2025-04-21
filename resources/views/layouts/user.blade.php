@props(['title' => ''])

{{-- * Passing props dari base layout --}}
<x-base-layout title="{{ $title }}">
    <x-layouts.user-header />
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

    {{ $slot }}
    <x-layouts.footer />
</x-base-layout>

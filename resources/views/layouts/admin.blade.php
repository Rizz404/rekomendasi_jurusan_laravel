@props(['title' => ''])

<x-base-layout title="{{ $title }}">
    <x-layouts.header />
    {{ $slot }}
    <x-layouts.footer />
</x-base-layout>

@props(['href' => '#'])

<a href="{{ $href }}"
    {{ $attributes->class([
        'inline-flex items-center justify-center px-4 py-2 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2',
        'bg-slate-700 text-white hover:bg-slate-800 focus:ring-slate-500' => !$attributes->has(
            'class',
        ),
    ]) }}>
    {{ $slot }}
</a>

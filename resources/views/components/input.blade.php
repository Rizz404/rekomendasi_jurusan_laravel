@props([
    'name' => null,
    'label' => null,
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
    'value' => null,
    'autocomplete' => null,
    'step' => null,
])

@php
    // * Mengubah nama field dari bracket ke dot notation
    $dotName = str_replace(['[', ']'], ['.', ''], $name);
@endphp

@if ($name)
    <div class="space-y-2">
        @if ($label)
            <label for="{{ $name }}"
                class="block text-sm font-medium text-slate-800">
                {{ $label }}
                @if ($required)
                    <span class="text-red-500 ml-0.5">*</span>
                @endif
            </label>
        @endif

        <div class="relative">
            <input type="{{ $type }}" id="{{ $name }}"
                name="{{ $name }}" placeholder="{{ $placeholder }}"
                value="{{ old($dotName, $value) }}"
                autocomplete="{{ $autocomplete }}" step="{{ $step }}"
                {{ $attributes->class([
                    'w-full px-3 py-2 border rounded-md shadow-sm transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-opacity-50',
                    'border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' => $errors->has(
                        $dotName,
                    ),
                    'border-slate-300 text-slate-900 focus:ring-slate-500 focus:border-slate-500' => !$errors->has(
                        $dotName,
                    ),
                ]) }}>

            @if ($errors->has($dotName))
                <div
                    class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            @endif
        </div>

        @error($dotName)
            <p class="flex items-center mt-1 text-sm text-red-600">
                <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
        @enderror
    </div>
@endif

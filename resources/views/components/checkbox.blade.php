@props([
    'name' => null,
    'label' => null,
    'options' => null,
    'multiple' => false,
    'required' => false,
])


<div class="space-y-2">
    @if ($label)
        <label class="block text-sm font-medium text-slate-800 mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-red-500 ml-0.5">*</span>
            @endif
        </label>
    @endif

    <div class="{{ $multiple ? 'space-y-2' : 'flex items-center' }}">
        @if ($options)
            @foreach ($options as $value => $optionLabel)
                <div class="flex items-center">
                    <div class="relative flex items-center">
                        <input type="{{ $multiple ? 'checkbox' : 'checkbox' }}"
                            id="{{ $name }}{{ $multiple ? '_' . $value : '' }}"
                            name="{{ $multiple ? $name . '[]' : $name }}"
                            value="{{ $value }}"
                            {{ $multiple ? '' : 'class="rounded border-slate-300 text-slate-700 focus:ring-slate-500 focus:border-slate-500 shadow-sm"' }}
                            {{ $attributes->class([
                                'rounded border-slate-300 text-slate-700 focus:ring-slate-500 focus:border-slate-500 shadow-sm',
                                'border-red-500' => $errors->has($name),
                            ]) }}>
                        @if ($errors->has($name))
                            <div
                                class="absolute -top-1 -right-1 pointer-events-none">
                                <svg class="h-4 w-4 text-red-500"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <label
                        for="{{ $name }}{{ $multiple ? '_' . $value : '' }}"
                        class="ml-2 text-sm text-slate-700">
                        {{ $optionLabel }}
                    </label>
                </div>
            @endforeach
        @else
            <div class="relative flex items-center">
                <input type="checkbox" id="{{ $name }}"
                    name="{{ $name }}" value="1"
                    {{ $attributes->class([
                        'rounded border-slate-300 text-slate-700 focus:ring-slate-500 focus:border-slate-500 shadow-sm',
                        'border-red-500' => $errors->has($name),
                    ]) }}>
                @if ($errors->has($name))
                    <div class="absolute -top-1 -right-1 pointer-events-none">
                        <svg class="h-4 w-4 text-red-500" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif
            </div>
            <label for="{{ $name }}"
                class="ml-2 text-sm text-slate-700">
                {{ $label }}
                @if ($required)
                    <span class="text-red-500 ml-0.5">*</span>
                @endif
            </label>
        @endif
    </div>

    @error($name)
        <p class="mt-1 text-sm text-red-600 flex items-center">
            <svg class="h-4 w-4 mr-1 text-red-500" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>

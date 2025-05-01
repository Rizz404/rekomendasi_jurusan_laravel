@props(['name' => 'search', 'placeholder' => null, 'value' => null])

<input type="text" name="{{ $name }}" placeholder="{{ $placeholder }}"
    class="w-full rounded-l-md py-1 px-0.5 font-body border shadow-sm transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-opacity-50 border-teto-primary text-teto-dark-text focus:ring-teto-primary focus:border-teto-primary pl-2"
    value="{{ $value }}">
<button type="submit"
    class="bg-teto-primary hover:bg-teto-primary-hover text-white px-4 rounded-r-md cursor-pointer">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
</button>

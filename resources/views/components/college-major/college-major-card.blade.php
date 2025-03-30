@props(['collegeMajor'])

<a href="{{ route('college-majors.show', $collegeMajor) }}"
    class="bg-white rounded-md shadow-sm hover:shadow-md transition-shadow duration-300 border border-slate-100">
    <div class="p-6">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-lg font-semibold text-slate-800">
                {{ $collegeMajor->major_name }}</h3>
            <span
                class="px-3 py-1 text-sm rounded-full {{ $collegeMajor->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $collegeMajor->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>

        <div class="space-y-2 text-slate-600">
            @if ($collegeMajor->faculty)
                <div class="flex items-center text-sm">
                    <svg class="w-5 h-5 mr-2 text-slate-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    {{ $collegeMajor->faculty }}
                </div>
            @endif

            @if ($collegeMajor->field_of_study)
                <div class="flex items-center text-sm">
                    <svg class="w-5 h-5 mr-2 text-slate-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    {{ $collegeMajor->field_of_study }}
                </div>
            @endif
        </div>

        @if ($collegeMajor->description)
            <div class="mt-4 text-sm text-slate-600 line-clamp-3">
                {{ $collegeMajor->description }}
            </div>
        @endif

        @if ($collegeMajor->career_prospects)
            <div class="mt-4 pt-4 border-t border-slate-100">
                <h4 class="text-sm font-medium text-slate-800 mb-2">
                    Prospek Karir:</h4>
                <div class="text-sm text-slate-600 line-clamp-2">
                    {{ $collegeMajor->career_prospects }}
                </div>
            </div>
        @endif
    </div>
</a>

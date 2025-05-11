@props(['criteria'])

<a href="{{ route('admin.criterias.show', $criteria) }}"
    class="transition-shadow duration-300 bg-white border rounded-md shadow-sm hover:shadow-md border-slate-100">
    <div class="p-6">
        <div class="flex items-start justify-between mb-4">
            <h3 class="text-lg font-semibold text-slate-800">
                {{ $criteria->name }}</h3>
            <span
                class="px-3 py-1 text-sm rounded-full {{ $criteria->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $criteria->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>

        <div class="space-y-2 text-slate-600">
            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                </svg>
                <span class="font-medium">Bobot:</span> {{ $criteria->weight }}
            </div>

            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">Tipe:</span>
                <span
                    class="{{ $criteria->type === 'benefit' ? 'text-blue-600' : 'text-orange-600' }} ml-1">
                    {{ $criteria->type === 'benefit' ? 'Benefit' : 'Cost' }}
                </span>
            </div>

            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="font-medium">Tipe Sekolah:</span>
                {{ $criteria->school_type }}
            </div>
        </div>

        @if ($criteria->description)
            <div class="mt-4 text-sm text-slate-600 line-clamp-3">
                {{ $criteria->description }}
            </div>
        @endif
    </div>
</a>

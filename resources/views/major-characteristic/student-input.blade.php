<x-user-layout title="Input Nilai">
    <div class="container max-w-2xl py-6">
        <form action="" method="POST" class="flex flex-col gap-4">
            @foreach ($criterias as $criteria)
                <x-input label="{{ $criteria->name }}" name="name"
                    placeholder="Masukkan nama kriteria" required />
            @endforeach
        </form>
    </div>
</x-user-layout>

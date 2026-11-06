<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Mijn rooster
        </h2>
    </x-slot>

    <div class="min-h-screen bg-blue-50 px-6 py-10">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-blue-950">
                    Mijn rooster
                </h1>
                <div class="mt-2 text-gray-600">
                    Hier zie je de lessen die aan jou zijn toegewezen.
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($lessen as $les)
                    <div class="overflow-hidden rounded-2xl bg-white shadow-md">
                        <div class="border-b border-blue-100 bg-blue-100 px-6 py-5">
                            <h3 class="text-xl font-bold text-blue-950">
                                {{ $les->naam }}
                            </h3>
                        </div>

                        <div class="space-y-4 p-6 text-gray-700">
                            <div class="flex items-center gap-3">
                                <span>📅</span>
                                <span>{{ \Carbon\Carbon::parse($les->datum)->format('d-m-Y') }}</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <span>🕒</span>
                                <span>
                                    {{ \Carbon\Carbon::parse($les->begintijd)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($les->eindtijd)->format('H:i') }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3">
                                <span>📍</span>
                                <span>{{ $les->locatie }}</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <span>👥</span>
                                <span>Maximaal {{ $les->max_deelnemers }} deelnemers</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-600">
                        Er zijn nog geen lessen aan jou toegewezen.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
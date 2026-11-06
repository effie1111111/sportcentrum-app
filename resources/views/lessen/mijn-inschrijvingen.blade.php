<x-app-layout>
    {{-- Welkomstbanner --}}
    <div class="bg-blue-700 px-6 py-10 text-white">
        <div class="mx-auto max-w-7xl">
            <div class="mb-2 text-sm font-semibold uppercase tracking-wider text-blue-200">
                Sportcentrum De Linde
            </div>

            <h1 class="text-3xl font-bold">
                Mijn inschrijvingen
            </h1>

            <div class="mt-2 text-blue-100">
                Bekijk de lessen waarvoor je bent ingeschreven.
            </div>
        </div>
    </div>

    {{-- Inschrijvingen --}}
    <div class="min-h-screen bg-blue-50 px-6 py-10">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-blue-950">
                    Mijn lessen
                </h2>
                <div class="mt-1 text-gray-600">
                    Hier vind je de gegevens van je inschrijvingen.
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($inschrijvingen as $inschrijving)
                    <div class="overflow-hidden rounded-2xl bg-white shadow-md">
                        <div class="border-b border-blue-100 bg-blue-100 px-6 py-5">
                            <h3 class="text-xl font-bold capitalize text-blue-950">
                                {{ $inschrijving->lesson->naam }}
                            </h3>

                            <div class="mt-1 text-sm text-blue-700">
                                Status: {{ $inschrijving->status }}
                            </div>
                        </div>

                        <div class="space-y-4 p-6">
                            <div class="flex items-center gap-3 text-gray-700">
                                <span>📅</span>
                                <span>
                                    {{ \Carbon\Carbon::parse($inschrijving->lesson->datum)->format('d-m-Y') }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3 text-gray-700">
                                <span>🕒</span>
                                <span>
                                    {{ \Carbon\Carbon::parse($inschrijving->lesson->begintijd)->format('H:i') }}
                                    @if ($inschrijving->lesson->eindtijd)
                                        - {{ \Carbon\Carbon::parse($inschrijving->lesson->eindtijd)->format('H:i') }}
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-center gap-3 text-gray-700">
                                <span>📍</span>
                                <span>{{ $inschrijving->lesson->locatie }}</span>
                            </div>

                            <form method="POST" action="{{ route('inschrijvingen.annuleren', $inschrijving) }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="mt-3 w-full rounded-lg bg-blue-700 px-4 py-3 font-semibold text-white transition hover:bg-blue-800">
                                    Inschrijving annuleren
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-600">
                        Je hebt je nog niet ingeschreven voor lessen.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
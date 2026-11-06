<x-app-layout>

    {{-- Welkomstbanner --}}
    <div class="bg-blue-700 px-6 py-10 text-white">
        <div class="mx-auto max-w-7xl">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-blue-200">
                Sportcentrum De Linde
            </p>

            <h1 class="text-3xl font-bold">
                Kom in beweging!
            </h1>

            <p class="mt-2 text-blue-100">
                Ontdek ons lesaanbod en vind een les die bij jou past.
            </p>
        </div>
    </div>

    {{-- Lesaanbod --}}
    <div class="min-h-screen bg-blue-50 px-6 py-10">
        <div class="mx-auto max-w-7xl">

            {{-- Meldingen --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-blue-950">
                    Ons lesaanbod
                </h2>
                <p class="mt-1 text-gray-600">
                    Bekijk onze lessen en schrijf je eenvoudig in.
                </p>
            </div>

            {{-- Leskaarten --}}
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                @forelse ($lessen as $les)
                    <div class="overflow-hidden rounded-2xl bg-white shadow-md transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="border-b border-blue-100 bg-blue-100 px-6 py-5">
                            <h3 class="text-xl font-bold capitalize text-blue-950">
                                {{ $les->naam }}
                            </h3>

                          <p class="mt-1 text-sm text-blue-700">
    Begeleider: {{ $les->begeleider->name ?? 'Nog niet bekend' }}
</p>
                        </div>

                        <div class="space-y-4 p-6">

                            <div class="flex items-center gap-3 text-gray-700">
                                <span>📅</span>
                                <span>
                                    {{ \Carbon\Carbon::parse($les->datum)->format('d-m-Y') }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3 text-gray-700">
                                <span>🕒</span>
                                <span>
                                    {{ \Carbon\Carbon::parse($les->begintijd)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($les->eindtijd)->format('H:i') }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3 text-gray-700">
                                <span>📍</span>
                                <span>{{ $les->locatie }}</span>
                            </div>

                            <div class="flex items-center gap-3 text-gray-700">
                                <span>👥</span>
                                <span>
                                    Maximaal {{ $les->max_deelnemers }} deelnemers
                                </span>
                            </div>

                            <form method="POST" action="{{ route('lessen.inschrijven', $les) }}">
                                @csrf

                                <button
                                    type="submit"
                                    class="mt-3 w-full rounded-lg bg-blue-700 px-4 py-3 font-semibold text-white transition hover:bg-blue-800">
                                    Inschrijven
                                </button>
                            </form>

                        </div>
                    </div>

                @empty
                    <p class="text-gray-600">
                        Er zijn momenteel geen lessen beschikbaar.
                    </p>
                @endforelse

            </div>
        </div>
    </div>

</x-app-layout>
```
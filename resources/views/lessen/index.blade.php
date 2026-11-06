<x-app-layout>
    <div class="bg-blue-700 px-6 py-10 text-white">
        <div class="mx-auto max-w-7xl">
            <div class="mb-2 text-sm font-semibold uppercase tracking-wider text-blue-200">
                Sportcentrum De Linde
            </div>

            <h1 class="text-3xl font-bold">Kom in beweging!</h1>

            <div class="mt-2 text-blue-100">
                @if (auth()->user()->role === 'begeleider')
                    Bekijk de lessen in jouw rooster.
                @else
                    Ontdek ons lesaanbod en vind een les die bij jou past.
                @endif
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-blue-50 px-6 py-10">
        <div class="mx-auto max-w-7xl">
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
                    @if (auth()->user()->role === 'begeleider')
                        Mijn rooster
                    @else
                        Ons lesaanbod
                    @endif
                </h2>

                <div class="mt-1 text-gray-600">
                    @if (auth()->user()->role === 'begeleider')
                        Dit zijn de lessen die aan jou zijn toegewezen.
                    @else
                        Bekijk onze lessen en schrijf je eenvoudig in.
                    @endif
                </div>
            </div>

            @if (auth()->user()->role !== 'begeleider')
                <form
                    method="GET"
                    action="{{ route('lessen.index') }}"
                    class="mb-8 flex flex-col gap-3 rounded-xl bg-white p-5 shadow-sm sm:flex-row sm:items-end">
                    <div class="flex-1">
                        <label for="begeleider_id" class="mb-1 block font-medium text-gray-700">
                            Filter op begeleider
                        </label>

                        <select
                            id="begeleider_id"
                            name="begeleider_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">Alle begeleiders</option>

                            @foreach ($begeleiders as $begeleider)
                                <option
                                    value="{{ $begeleider->id }}"
                                    @selected((string) $selectedBegeleider === (string) $begeleider->id)>
                                    {{ $begeleider->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="rounded-lg bg-blue-700 px-5 py-3 font-semibold text-white hover:bg-blue-800">
                        Filter toepassen
                    </button>

                    @if ($selectedBegeleider)
                        <a
                            href="{{ route('lessen.index') }}"
                            class="rounded-lg bg-gray-200 px-5 py-3 text-center font-semibold text-gray-700 hover:bg-gray-300">
                            Filter wissen
                        </a>
                    @endif
                </form>
            @endif

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($lessen as $les)
                    <div class="overflow-hidden rounded-2xl bg-white shadow-md transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="border-b border-blue-100 bg-blue-100 px-6 py-5">
                            <h3 class="text-xl font-bold capitalize text-blue-950">
                                {{ $les->naam }}
                            </h3>

                            <div class="mt-1 text-sm text-blue-700">
                                Begeleider: {{ $les->begeleider->name ?? 'Nog niet bekend' }}
                            </div>
                        </div>

                        <div class="space-y-4 p-6">
                            <div class="flex items-center gap-3 text-gray-700">
                                <span>📅</span>
                                <span>{{ \Carbon\Carbon::parse($les->datum)->format('d-m-Y') }}</span>
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
                                <span>Maximaal {{ $les->max_deelnemers }} deelnemers</span>
                            </div>

                            @if (auth()->user()->role === 'gebruiker')
                                <form method="POST" action="{{ route('lessen.inschrijven', $les) }}">
                                    @csrf

                                    <button
                                        type="submit"
                                        class="mt-3 w-full rounded-lg bg-blue-700 px-4 py-3 font-semibold text-white transition hover:bg-blue-800">
                                        Inschrijven
                                    </button>
                                </form>
                            @endif

                            @if (auth()->user()->role === 'admin' || auth()->user()->rol === 'beheerder')
                                <form
                                    method="POST"
                                    action="{{ route('lessen.verwijderen', $les) }}"
                                    onsubmit="return confirm('Weet je zeker dat je deze les wilt verwijderen? De inschrijvingen worden ook verwijderd.')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="w-full rounded-lg bg-red-600 px-4 py-3 font-semibold text-white transition hover:bg-red-700">
                                        Les verwijderen
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-gray-600">
                        @if (auth()->user()->role === 'begeleider')
                            Er zijn nog geen lessen aan jou toegewezen.
                        @else
                            Er zijn geen lessen gevonden voor deze begeleider.
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
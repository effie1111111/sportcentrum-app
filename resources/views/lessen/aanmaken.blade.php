<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Les aanmaken
        </h2>
    </x-slot>

    <div class="min-h-screen bg-blue-50 px-6 py-10">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-2xl bg-white p-8 shadow-md">
                <h1 class="mb-6 text-2xl font-bold text-blue-950">
                    Nieuwe les aanmaken
                </h1>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('lessen.opslaan') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="naam" class="mb-1 block font-medium text-gray-700">
                            Naam van de les
                        </label>
                        <input
                            type="text"
                            id="naam"
                            name="naam"
                            value="{{ old('naam') }}"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label for="datum" class="mb-1 block font-medium text-gray-700">
                            Datum
                        </label>
                        <input
                            type="date"
                            id="datum"
                            name="datum"
                            value="{{ old('datum') }}"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label for="begintijd" class="mb-1 block font-medium text-gray-700">
                            Begintijd
                        </label>
                        <input
                            type="time"
                            id="begintijd"
                            name="begintijd"
                            value="{{ old('begintijd') }}"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label for="eindtijd" class="mb-1 block font-medium text-gray-700">
                            Eindtijd
                        </label>
                        <input
                            type="time"
                            id="eindtijd"
                            name="eindtijd"
                            value="{{ old('eindtijd') }}"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label for="locatie" class="mb-1 block font-medium text-gray-700">
                            Locatie
                        </label>
                        <input
                            type="text"
                            id="locatie"
                            name="locatie"
                            value="{{ old('locatie') }}"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label for="max_deelnemers" class="mb-1 block font-medium text-gray-700">
                            Maximaal aantal deelnemers
                        </label>
                        <input
                            type="number"
                            id="max_deelnemers"
                            name="max_deelnemers"
                            value="{{ old('max_deelnemers') }}"
                            min="1"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label for="begeleider_id" class="mb-1 block font-medium text-gray-700">
                            Begeleider
                        </label>
                        <select
                            id="begeleider_id"
                            name="begeleider_id"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">Kies een begeleider</option>

                            @foreach ($begeleiders as $begeleider)
                                <option
                                    value="{{ $begeleider->id }}"
                                    @selected(old('begeleider_id') == $begeleider->id)>
                                    {{ $begeleider->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="rounded-lg bg-blue-700 px-5 py-3 font-semibold text-white hover:bg-blue-800">
                        Les opslaan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Mijn inschrijvingen
        </h2>
    </x-slot>

    <div class="p-6">
        @forelse ($inschrijvingen as $inschrijving)
            <h3>{{ $inschrijving->lesson->naam }}</h3>

            <p>Datum: {{ \Carbon\Carbon::parse($inschrijving->lesson->datum)->format('d-m-Y') }}</p>
            <p>Begintijd: {{ \Carbon\Carbon::parse($inschrijving->lesson->begintijd)->format('H:i') }}</p>
            <p>Locatie: {{ $inschrijving->lesson->locatie }}</p>
            <p>Status: {{ $inschrijving->status }}</p>

            <form method="POST" action="{{ route('inschrijvingen.annuleren', $inschrijving) }}">
                @csrf
                @method('DELETE')

                <button type="submit">Inschrijving annuleren</button>
            </form>

        @empty
            <p>Je hebt je nog niet ingeschreven voor lessen.</p>
        @endforelse
    </div>
</x-app-layout>
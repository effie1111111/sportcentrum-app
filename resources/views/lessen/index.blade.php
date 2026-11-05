<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Beschikbare lessen
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
        @foreach ($lessen as $les)
          <h3>{{ $les->naam }}</h3>
        <p>Datum: {{ \Carbon\Carbon::parse($les->datum)->format('d-m-Y') }}</p>
        <p>Begintijd: {{ \Carbon\Carbon::parse($les->begintijd)->format('H:i') }}</p>
        <p>Eindtijd: {{ \Carbon\Carbon::parse($les->eindtijd)->format('H:i') }}</p>
        <p>Locatie: {{ $les->locatie }}</p>
        <p>Maximaal aantal deelnemers: {{ $les->max_deelnemers }}</p>
        <form method="POST" action="{{ route('lessen.inschrijven', $les) }}">
    @csrf
    <button type="submit">Inschrijven</button>
</form>
        @endforeach
    </div>
</x-app-layout>
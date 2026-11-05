<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Les aanmaken
        </h2>
    </x-slot>

    <form method="POST" action="{{ url('/lessen/aanmaken') }}">
        @csrf

        <div class="p-6">
            <label for="naam">Naam van de les</label>
            <input type="text" id="naam" name="naam" class="border rounded p-2">

            <br><br>

            <label for="datum">Datum</label>
            <input type="date" id="datum" name="datum" class="border rounded p-2">
            <br><br>

                 <label for="begintijd">Begintijd</label>
                <input type="time" id="begintijd" name="begintijd" class="border rounded p-2">
            <br><br>

            <label for="eindtijd">Eindtijd</label>
            <input type="time" id="eindtijd" name="eindtijd" class="border rounded p-2">
        <br><br>
            <label for="locatie">Locatie</label>
            <input type="text" id="locatie" name="locatie" class="border rounded p-2">
        <br><br>
            <br><br>

        <label for="max_deelnemers">Maximaal aantal deelnemers</label>
            <input type="number" id="max_deelnemers" name="max_deelnemers" min="1" class="border rounded p-2">

            <br><br>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Les opslaan
            </button>
        </div>
    </form>
</x-app-layout>
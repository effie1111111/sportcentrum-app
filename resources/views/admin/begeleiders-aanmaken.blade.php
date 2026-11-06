<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Begeleider aanmaken
        </h2>
    </x-slot>

    <div class="min-h-screen bg-blue-50 px-6 py-10">
        <div class="mx-auto max-w-3xl rounded-2xl bg-white p-8 shadow-md">
            <h1 class="mb-6 text-2xl font-bold text-blue-950">
                Nieuwe begeleider
            </h1>

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.begeleiders.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="mb-1 block font-medium">Naam</label>
                    <input id="name" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-lg border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="email" class="mb-1 block font-medium">E-mailadres</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                           class="w-full rounded-lg border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="telefoon" class="mb-1 block font-medium">Telefoon</label>
                    <input id="telefoon" name="telefoon" value="{{ old('telefoon') }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="password" class="mb-1 block font-medium">Wachtwoord</label>
                    <input id="password" name="password" type="password" required
                           class="w-full rounded-lg border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1 block font-medium">
                        Wachtwoord bevestigen
                    </label>
                    <input id="password_confirmation" name="password_confirmation"
                           type="password" required
                           class="w-full rounded-lg border-gray-300 shadow-sm">
                </div>

                <button type="submit"
                        class="rounded-lg bg-blue-700 px-5 py-3 font-semibold text-white hover:bg-blue-800">
                    Begeleider aanmaken
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
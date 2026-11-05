
<nav x-data="{ open: false }" class="border-b border-blue-800 bg-blue-700">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="text-lg font-bold text-white">
                    Sportcentrum De Linde
                </a>

                <div class="hidden items-center gap-6 sm:flex">
                    <a href="{{ route('dashboard') }}" class="text-sm text-white hover:text-blue-200">
                        Dashboard
                    </a>

                    <a href="{{ route('lessen.index') }}" class="text-sm text-white hover:text-blue-200">
                        Lessen
                    </a>

                    <a href="{{ route('lessen.mijn-inschrijvingen') }}" class="text-sm text-white hover:text-blue-200">
                        Mijn inschrijvingen
                    </a>
                </div>
            </div>

            <div class="hidden sm:block">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="text-sm font-medium text-white hover:text-blue-200">
                            {{ Auth::user()->name }} ▼
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profiel
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Uitloggen
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <button @click="open = !open" class="text-white sm:hidden">
                Menu
            </button>
        </div>
    </div>

    <div x-show="open" class="space-y-2 px-4 pb-4 sm:hidden">
        <a href="{{ route('dashboard') }}" class="block text-white">Dashboard</a>
        <a href="{{ route('lessen.index') }}" class="block text-white">Lessen</a>
        <a href="{{ route('lessen.mijn-inschrijvingen') }}" class="block text-white">Mijn inschrijvingen</a>
    </div>
</nav>

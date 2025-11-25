<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer une réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">{{ $salle->nom_salle }}</h3>
                        <p class="text-lg"><strong>{{ __('Adresse:') }}</strong> {{ $salle->adresse }}</p>
                        <p class="text-lg"><strong>{{ __('Capacité totale:') }}</strong> {{ $salle->capacite }} {{ __('personnes') }}</p>
                    </div>

                    <div class="mt-6">
                        <form action="{{ route('reservation.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="salle_id" value="{{ $salle->id }}">

                            <div class="mb-4">
                                <label for="date_reservation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Date') }}</label>
                                <input type="date" name="date_reservation" id="date_reservation" value="{{ $date ?? '' }}" min="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                                @error('date_reservation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="heure_debut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Heure') }}</label>
                                <input type="time" name="heure_debut" id="heure_debut" value="{{ $heure ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                                @error('heure_debut')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="nombre_personnes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nombre de personnes') }}</label>
                                <input type="number" name="nombre_personnes" id="nombre_personnes" min="1" max="{{ $salle->capacite }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                                @error('nombre_personnes')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded text-lg">
                                    {{ __('Confirmer la réservation') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

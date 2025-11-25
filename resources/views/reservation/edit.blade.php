<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier la réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">{{ $salle->nom_salle }}</h3>
                        <p class="text-lg"><strong>Date:</strong> {{ \Carbon\Carbon::parse($spectacle->date_spectacle)->format('d/m/Y') }}</p>
                        <p class="text-lg"><strong>Heure:</strong> {{ \Carbon\Carbon::parse($spectacle->heure_spectacle)->format('H:i') }}</p>
                        <p class="text-lg"><strong>Places disponibles supplémentaires:</strong> {{ $remainingPlaces }}</p>
                    </div>

                    <div class="mt-6">
                        <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="nombre_personnes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de personnes</label>
                                <input type="number" name="nombre_personnes" id="nombre_personnes" min="1" max="{{ $remainingPlaces + $reservation->nombre_personnes }}" value="{{ $reservation->nombre_personnes }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                                @error('nombre_personnes')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">Vous pouvez augmenter jusqu'à {{ $remainingPlaces + $reservation->nombre_personnes }} personnes au total.</p>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('reservation.my') }}" class="text-gray-600 hover:text-gray-900 mr-4">Annuler</a>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded text-lg">
                                    Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

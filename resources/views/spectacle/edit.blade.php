<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Modifier un Spectacle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('spectacle.update', $spectacle->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="salle_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salle</label>
                            <select name="salle_id" id="salle_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                                @foreach($salles as $salle)
                                    <option value="{{ $salle->id }}" {{ (old('salle_id', $spectacle->salle_id) == $salle->id) ? 'selected' : '' }}>
                                        {{ $salle->nom_salle }} (Capacité: {{ $salle->capacite }})
                                    </option>
                                @endforeach
                            </select>
                            @error('salle_id')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="date_spectacle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date du spectacle</label>
                            <input type="date" name="date_spectacle" id="date_spectacle" value="{{ old('date_spectacle', $spectacle->date_spectacle) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                            @error('date_spectacle')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="heure_spectacle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Heure du spectacle</label>
                            <input type="time" name="heure_spectacle" id="heure_spectacle" value="{{ old('heure_spectacle', $spectacle->heure_spectacle) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                            @error('heure_spectacle')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prix" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix (€)</label>
                            <input type="number" name="prix" id="prix" value="{{ old('prix', $spectacle->prix) }}" step="0.01" min="0" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                            @error('prix')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

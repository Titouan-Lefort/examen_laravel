<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un Spectacle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('spectacle.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="salle_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Salle') }}</label>
                            <select name="salle_id" id="salle_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                                <option value="">{{ __('Sélectionner une salle') }}</option>
                                @foreach($salles as $salle)
                                    <option value="{{ $salle->id }}" {{ (old('salle_id') == $salle->id || (isset($selected_salle_id) && $selected_salle_id == $salle->id)) ? 'selected' : '' }}>
                                        {{ $salle->nom_salle }} ({{ __('Capacité:') }} {{ $salle->capacite }})
                                    </option>
                                @endforeach
                            </select>
                            @error('salle_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="date_spectacle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Date du spectacle') }}</label>
                            <input type="date" name="date_spectacle" id="date_spectacle" value="{{ old('date_spectacle') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                            @error('date_spectacle')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="heure_spectacle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Heure du spectacle') }}</label>
                            <input type="time" name="heure_spectacle" id="heure_spectacle" value="{{ old('heure_spectacle') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                            @error('heure_spectacle')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prix" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Prix (€)') }}</label>
                            <input type="number" name="prix" id="prix" value="{{ old('prix') }}" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>
                            @error('prix')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Ajouter le spectacle') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

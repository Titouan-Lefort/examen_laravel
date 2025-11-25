<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des Salles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-6">
                <a href="{{ route('salle.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Ajouter une salle
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <table class="min-w-full w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-lg leading-normal">
                                <th class="py-4 px-6 text-left">Nom</th>
                                <th class="py-4 px-6 text-left">Capacité</th>
                                <th class="py-4 px-6 text-left">Adresse</th>
                                <th class="py-4 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-200 text-xl font-light">
                            @foreach($salles as $salle)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" style="cursor: pointer;" onclick="window.location='{{ route('salle.show', $salle->id) }}'">
                                <td class="py-4 px-6 text-left whitespace-nowrap">
                                    <span class="font-medium">{{ $salle->nom_salle }}</span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <span>{{ $salle->capacite }}</span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <span>{{ $salle->adresse }}</span>
                                </td>
                                <td class="py-4 px-6 text-center" onclick="event.stopPropagation()">
                                    <div class="flex items-center justify-center">
                                        <a href="{{ route('salle.edit', $salle->id) }}" class="mr-2 transform hover:text-purple-500 hover:scale-110 inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 32px; height: 32px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('salle.destroy', $salle->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette salle ?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="transform hover:text-red-500 hover:scale-110 inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 32px; height: 32px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

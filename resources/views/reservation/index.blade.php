<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Spectacles Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                <th class="py-4 px-6 text-left">Date & Heure</th>
                                <th class="py-4 px-6 text-left">Salle</th>
                                <th class="py-4 px-6 text-left">Prix</th>
                                <th class="py-4 px-6 text-left">Places Restantes</th>
                                <th class="py-4 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-200 text-xl font-light">
                            @forelse($availableSpectacles as $spectacle)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer"
                                onclick="window.location='{{ route('reservation.show', $spectacle->id) }}'">
                                <td class="py-4 px-6 text-left whitespace-nowrap">
                                    <span>{{ \Carbon\Carbon::parse($spectacle->date_spectacle)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($spectacle->heure_spectacle)->format('H:i') }}</span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <span class="font-medium">{{ $spectacle->salle->nom_salle }}</span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <span>{{ number_format($spectacle->prix, 2) }} €</span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <span>{{ $spectacle->places_restantes }}</span>
                                </td>
                                <td class="py-4 px-6 text-center" onclick="event.stopPropagation()">
                                    <a href="{{ route('reservation.show', $spectacle->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Réserver
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-6 px-6 text-center">Aucun spectacle disponible pour le moment.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

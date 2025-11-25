<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $salle->nom_salle }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $salle->nom_salle }}</h2>
                        <a href="{{ route('salle.index') }}" class="text-blue-500 hover:text-blue-800 text-lg">Retour à la liste</a>
                    </div>

                    <div class="mb-10 space-y-4">
                        <p class="text-gray-700 dark:text-gray-300 text-2xl"><strong>Adresse:</strong> {{ $salle->adresse }}</p>
                        <p class="text-gray-700 dark:text-gray-300 text-2xl"><strong>Capacité de la salle:</strong> {{ $salle->capacite }}</p>
                    </div>

                    <h3 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Spectacles programmés</h3>

                    @if($salle->spectacles->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400 italic">Aucun spectacle programmé dans cette salle.</p>
                    @else
                        <div class="space-y-8">
                            @foreach($salle->spectacles as $spectacle)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h4 class="text-xl font-bold text-gray-800 dark:text-white">
                                                {{ \Carbon\Carbon::parse($spectacle->date_spectacle)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($spectacle->heure_spectacle)->format('H:i') }}
                                            </h4>
                                            <p class="text-gray-600 dark:text-gray-300">Prix: {{ number_format($spectacle->prix, 2) }} €</p>
                                        </div>
                                        <div class="text-right">
                                            @php
                                                $reserved = $spectacle->reservations->sum('nombre_personnes');
                                                $remaining = $salle->capacite - $reserved;
                                            @endphp
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Réservations: {{ $reserved }} / {{ $salle->capacite }}</p>
                                            <p class="font-bold {{ $remaining > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                Restant: {{ $remaining }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <h5 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">Liste des réservations:</h5>
                                        @if($spectacle->reservations->isEmpty())
                                            <p class="text-sm text-gray-500 italic">Aucune réservation.</p>
                                        @else
                                            <ul class="list-disc list-inside text-sm">
                                                @foreach($spectacle->reservations as $reservation)
                                                    <li class="text-gray-700 dark:text-gray-300">
                                                        <span class="font-medium">{{ $reservation->user->name }} {{ $reservation->user->prenom }}</span>
                                                        - {{ $reservation->nombre_personnes }} personne(s)
                                                        <span class="text-gray-500">({{ $reservation->user->email }})</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

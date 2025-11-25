<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $salle->nom_salle }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-4xl font-bold dark:text-gray-100 dark:text-white">{{ $salle->nom_salle }}</h2>
                        <a href="{{ route('salle.index') }}" class="text-lg text-blue-500 hover:text-blue-800">{{ __('Retour à la liste') }}</a>
                    </div>

                    <div class="mb-10 space-y-4">
                        <p class="text-2xl dark:text-gray-300"><strong>{{ __('Adresse:') }}</strong> {{ $salle->adresse }}</p>
                        <p class="text-2xl dark:text-gray-300"><strong>{{ __('Capacité de la salle:') }}</strong> {{ $salle->capacite }}</p>
                    </div>

                    <h3 class="mb-6 text-3xl font-bold dark:text-gray-300 dark:text-white">{{ __('Spectacles programmés') }}</h3>

                    @if($salle->spectacles->isEmpty())
                        <p class="italic dark:text-gray-300 dark:text-gray-400">{{ __('Aucun spectacle programmé dans cette salle.') }}</p>
                    @else
                        <div class="space-y-8">
                            @foreach($salle->spectacles as $spectacle)
                                <div class="p-6 rounded-lg shadow bg-gray-50 dark:text-gray-300">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h4 class="text-xl font-bold dark:text-gray-300 dark:text-white">
                                                {{ \Carbon\Carbon::parse($spectacle->date_spectacle)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($spectacle->heure_spectacle)->format('H:i') }}
                                            </h4>
                                            <p class="dark:text-gray-300">{{ __('Prix:') }} {{ number_format($spectacle->prix, 2) }} €</p>
                                            @if(Auth::check() && Auth::user()->isAn('admin'))
                                                <div class="mt-2">
                                                    <a href="{{ route('spectacle.edit', $spectacle->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        {{ __('Modifier') }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            @php
                                                $reserved = $spectacle->reservations->sum('nombre_personnes');
                                                $remaining = $salle->capacite - $reserved;
                                            @endphp
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Réservations:') }} {{ $reserved }} / {{ $salle->capacite }}</p>
                                            <p class="font-bold {{ $remaining > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ __('Restant:') }} {{ $remaining }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <h5 class="mb-2 font-semibold text-gray-700 dark:text-gray-200">{{ __('Liste des réservations:') }}</h5>
                                        @if($spectacle->reservations->isEmpty())
                                            <p class="text-sm italic text-gray-500">{{ __('Aucune réservation.') }}</p>
                                        @else
                                            <ul class="text-sm list-disc list-inside">
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

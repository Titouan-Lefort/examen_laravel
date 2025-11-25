<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">

            <!-- Section Salles -->
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="mb-4 text-2xl font-bold">{{ __('Salles et Réservations à venir') }}</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full table-auto">
                            <thead>
                                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-200">
                                    <th class="px-6 py-3 text-center">{{ __('Nom de la Salle') }}</th>
                                    <th class="px-6 py-3 text-center">{{ __('Capacité') }}</th>
                                    <th class="px-6 py-3 text-center">{{ __('Réservations à venir (Nombre)') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-light text-gray-600 dark:text-gray-200">
                                @forelse($sallesData as $salle)
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-3 text-center whitespace-nowrap">
                                        <span class="font-medium">{{ $salle->nom_salle }}</span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <span>{{ $salle->capacite }}</span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <span class="font-bold text-blue-500">{{ $salle->upcoming_reservations_count }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-6 text-center">{{ __('Aucune salle trouvée.') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Section Statistiques Mensuelles -->
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="mb-4 text-2xl font-bold">{{ __('Statistiques Mensuelles des Réservations') }}</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full table-auto">
                            <thead>
                                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-200">
                                    <th class="px-6 py-3 text-center">{{ __('Mois') }}</th>
                                    <th class="px-6 py-3 text-center">{{ __('Nombre de Réservations') }}</th>
                                    <th class="px-6 py-3 text-center">{{ __('Nombre de Places Réservées') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-light text-gray-600 dark:text-gray-200">
                                @forelse($monthlyStats as $stat)
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-3 text-center whitespace-nowrap">
                                        <span class="font-medium">{{ \Carbon\Carbon::createFromFormat('Y-m', $stat->month)->translatedFormat('F Y') }}</span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <span>{{ $stat->total_reservations }}</span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <span>{{ $stat->total_seats }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-6 text-center">{{ __('Aucune statistique disponible.') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

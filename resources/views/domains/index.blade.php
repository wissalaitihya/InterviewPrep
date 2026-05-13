<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mes domaines') }}
            </h2>
            <a href="{{ route('domains.create') }}">
                <x-primary-button>{{ __('Ajouter un domaine') }}</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-4" :status="session('success')" />

            @if ($domains->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    Aucun domaine pour le moment.
                    <a href="{{ route('domains.create') }}" class="text-indigo-600 hover:underline">Creez votre premier domaine.</a>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Couleur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Concepts</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Maitrises</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($domains as $domain)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('domains.show', $domain) }}" class="text-gray-900 hover:text-indigo-600 font-medium">
                                            {{ $domain->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block w-6 h-6 rounded-full border border-gray-200" style="background-color: {{ $domain->color }}"></span>
                                        <span class="ml-2 text-sm text-gray-500">{{ $domain->color }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                        {{ $domain->concepts_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-green-600 font-medium">
                                        {{ $domain->mastered_concepts_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                        <a href="{{ route('domains.edit', $domain) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                        <form method="POST" action="{{ route('domains.destroy', $domain) }}" class="inline" onsubmit="return confirm('Supprimer ce domaine et tous ses concepts ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
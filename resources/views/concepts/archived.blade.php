<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('domains.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Domaines</a>
                <span class="text-gray-400 mx-1">/</span>
                <a href="{{ route('concepts.index', $domain->id) }}" class="text-sm text-gray-500 hover:text-gray-700">{{ $domain->name }}</a>
                <span class="text-gray-400 mx-1">/</span>
                <span class="font-semibold text-xl text-gray-800 leading-tight">Concepts archives</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-4" :status="session('success')" />

            @if ($concepts->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    Aucun concept archive.
                    <a href="{{ route('concepts.index', $domain->id) }}" class="text-indigo-600 hover:underline">Retour aux concepts.</a>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Difficulte</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Archive le</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($concepts as $concept)
                                <tr class="opacity-60">
                                    <td class="px-6 py-4 text-gray-500">{{ $concept->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $concept->difficulty === 'junior' ? 'bg-gray-100 text-gray-700' : '' }}
                                            {{ $concept->difficulty === 'mid' ? 'bg-blue-100 text-blue-700' : '' }}
                                            {{ $concept->difficulty === 'senior' ? 'bg-purple-100 text-purple-700' : '' }}">
                                            {{ $concept->difficulty_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $concept->status === 'to_review' ? 'bg-red-100 text-red-700' : '' }}
                                            {{ $concept->status === 'in_progress' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $concept->status === 'mastered' ? 'bg-green-100 text-green-700' : '' }}">
                                            {{ $concept->status_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $concept->deleted_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <form method="POST" action="{{ route('concepts.restore', [$domain->id, $concept->id]) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">Restaurer</button>
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
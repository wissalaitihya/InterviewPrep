<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('domains.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Domaines</a>
                <span class="text-gray-400 mx-1">/</span>
                <span class="font-semibold text-xl text-gray-800 leading-tight">{{ $domain->name }}</span>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('concepts.archived', $domain->id) }}" class="text-sm text-gray-500 hover:text-gray-700 px-3 py-2 border border-gray-300 rounded-md">Archives</a>
                <a href="{{ route('concepts.create', $domain->id) }}">
                    <x-primary-button>Ajouter un concept</x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-4" :status="session('success')" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 flex gap-4 items-end">
                    <form method="GET" action="{{ route('concepts.index', $domain->id) }}" class="flex gap-3 items-end flex-wrap">
                        <div>
                            <x-input-label for="status" :value="__('Statut')" />
                            <select name="status" id="status" class="border-gray-300 rounded-md mt-1 text-sm" onchange="this.form.submit()">
                                <option value="">Tous</option>
                                <option value="to_review" {{ request('status') == 'to_review' ? 'selected' : '' }}>A revoir</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                                <option value="mastered" {{ request('status') == 'mastered' ? 'selected' : '' }}>Maitrise</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="difficulty" :value="__('Difficulte')" />
                            <select name="difficulty" id="difficulty" class="border-gray-300 rounded-md mt-1 text-sm" onchange="this.form.submit()">
                                <option value="">Toutes</option>
                                <option value="junior" {{ request('difficulty') == 'junior' ? 'selected' : '' }}>Junior</option>
                                <option value="mid" {{ request('difficulty') == 'mid' ? 'selected' : '' }}>Mid</option>
                                <option value="senior" {{ request('difficulty') == 'senior' ? 'selected' : '' }}>Senior</option>
                            </select>
                        </div>
                        @if(request('status') || request('difficulty'))
                            <a href="{{ route('concepts.index', $domain->id) }}" class="text-sm text-gray-500 hover:text-red-600 pb-1">Reinitialiser</a>
                        @endif
                    </form>
                </div>
            </div>

            @if ($concepts->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    Aucun concept pour ce domaine.
                    <a href="{{ route('concepts.create', $domain->id) }}" class="text-indigo-600 hover:underline">Creez le premier.</a>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Difficulte</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Statut</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($concepts as $concept)
                                <tr>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('concepts.show', [$domain->id, $concept->id]) }}" class="text-gray-900 hover:text-indigo-600 font-medium">
                                            {{ $concept->title }}
                                        </a>
                                    </td>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                        <form method="POST" action="{{ route('concepts.toggle-status', [$domain->id, $concept->id]) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900" title="Changer le statut">Statut</button>
                                        </form>
                                        <a href="{{ route('concepts.edit', [$domain->id, $concept->id]) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                        <form method="POST" action="{{ route('concepts.destroy', [$domain->id, $concept->id]) }}" class="inline" onsubmit="return confirm('Archiver ce concept ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Archiver</button>
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
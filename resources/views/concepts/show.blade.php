<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('domains.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Domaines</a>
                <span class="text-gray-400 mx-1">/</span>
                <a href="{{ route('concepts.index', $domain->id) }}" class="text-sm text-gray-500 hover:text-gray-700">{{ $domain->name }}</a>
                <span class="text-gray-400 mx-1">/</span>
                <span class="font-semibold text-xl text-gray-800 leading-tight">{{ $concept->title }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-4" :status="session('success')" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $concept->title }}</h1>
                        <div class="flex gap-3 mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $concept->status === 'to_review' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $concept->status === 'in_progress' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $concept->status === 'mastered' ? 'bg-green-100 text-green-700' : '' }}">
                                {{ $concept->status_label }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $concept->difficulty === 'junior' ? 'bg-gray-100 text-gray-700' : '' }}
                                {{ $concept->difficulty === 'mid' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $concept->difficulty === 'senior' ? 'bg-purple-100 text-purple-700' : '' }}">
                                {{ $concept->difficulty_label }}
                            </span>
                        </div>
                        <div class="prose max-w-none text-gray-700">
                            <p class="whitespace-pre-wrap">{{ $concept->explanation }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                    <form method="POST" action="{{ route('concepts.toggle-status', [$domain->id, $concept->id]) }}">
                        @csrf
                        <x-primary-button type="submit">Statut suivant</x-primary-button>
                    </form>
                    <a href="{{ route('concepts.edit', [$domain->id, $concept->id]) }}">
                        <x-secondary-button>Modifier</x-secondary-button>
                    </a>
                    <form method="POST" action="{{ route('concepts.destroy', [$domain->id, $concept->id]) }}" class="inline" onsubmit="return confirm('Archiver ce concept ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Archiver</button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Questions generees</h2>
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium" id="generate-questions-btn">
                        Generer des questions d'entretien
                    </a>
                </div>

                @if ($concept->generatedQuestions->isEmpty())
                    <p class="text-gray-500 text-sm">Aucune question generee pour le moment.</p>
                @else
                    <ul class="space-y-3">
                        @foreach ($concept->generatedQuestions as $gq)
                            <li class="border-l-4 border-indigo-200 pl-4 py-2">
                                <p class="text-gray-800 text-sm font-medium">Generation du {{ $gq->created_at->format('d/m/Y H:i') }}</p>
                                <ul class="mt-2 space-y-1">
                                    @foreach ($gq->questions as $q)
                                        <li class="text-gray-700 text-sm list-disc list-inside">{{ $q }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
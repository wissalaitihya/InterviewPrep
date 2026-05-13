<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier le concept</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('concepts.update', [$domain->id, $concept->id]) }}">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="title" :value="__('Titre')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $concept->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="explanation" :value="__('Explication')" />
                        <textarea id="explanation" name="explanation" rows="6" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('explanation', $concept->explanation) }}</textarea>
                        <x-input-error :messages="$errors->get('explanation')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="difficulty" :value="__('Difficulte')" />
                        <select name="difficulty" id="difficulty" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="junior" {{ old('difficulty', $concept->difficulty) === 'junior' ? 'selected' : '' }}>Junior</option>
                            <option value="mid" {{ old('difficulty', $concept->difficulty) === 'mid' ? 'selected' : '' }}>Mid</option>
                            <option value="senior" {{ old('difficulty', $concept->difficulty) === 'senior' ? 'selected' : '' }}>Senior</option>
                        </select>
                        <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Statut')" />
                        <select name="status" id="status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="to_review" {{ old('status', $concept->status) === 'to_review' ? 'selected' : '' }}>A revoir</option>
                            <option value="in_progress" {{ old('status', $concept->status) === 'in_progress' ? 'selected' : '' }}>En cours</option>
                            <option value="mastered" {{ old('status', $concept->status) === 'mastered' ? 'selected' : '' }}>Maitrise</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('concepts.show', [$domain->id, $concept->id]) }}" class="text-gray-600 hover:text-gray-900 mr-4">Annuler</a>
                        <x-primary-button>Enregistrer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouveau domaine') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('domains.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nom')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="color_hex" :value="__('Couleur')" />
                        <div class="flex items-center gap-3 mt-1">
                            <input type="color" id="color_picker" value="{{ old('color', '#3B82F6') }}" class="w-12 h-10 border border-gray-300 rounded cursor-pointer">
                            <x-text-input id="color_hex" class="block flex-1" type="text" name="color" :value="old('color', '#3B82F6')" placeholder="#3B82F6" />
                        </div>
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('domains.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Annuler</a>
                        <x-primary-button>{{ __('Creer') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    const picker = document.getElementById('color_picker');
    const hex = document.getElementById('color_hex');
    picker.addEventListener('input', () => { hex.value = picker.value; });
    hex.addEventListener('input', (e) => {
        if (/^#[0-9A-Fa-f]{6}$/.test(e.target.value)) picker.value = e.target.value;
    });
</script>
@endpush
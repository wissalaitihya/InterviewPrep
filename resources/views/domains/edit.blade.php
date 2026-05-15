<x-app-layout>
    <div class="p-md md:p-2xl max-w-2xl mx-auto w-full">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-xs text-on-surface-variant text-body-sm mb-xl">
            <a href="{{ route('domains.index') }}" class="hover:text-primary transition-colors flex items-center gap-xs">
                <span class="material-symbols-outlined text-[16px]">category</span>
                Domains
            </a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-on-surface font-medium">Edit Domain</span>
        </div>

        <!-- Page Header -->
        <div class="mb-xl flex items-start justify-between">
            <div>
                <h2 class="font-h1 text-h1 text-on-surface">Edit Domain</h2>
                <p class="text-on-surface-variant mt-xs">Update your domain settings and identity.</p>
            </div>
            <!-- Domain badge preview -->
            <span class="inline-block px-sm py-xs rounded-lg text-label-caps font-medium border"
                style="background-color: {{ $domain->color }}20; color: {{ $domain->color }}; border-color: {{ $domain->color }}40;">
                {{ strtoupper($domain->category ?? 'OTHER') }}
            </span>
        </div>

        <!-- Form Card -->
        <div class="glass-panel rounded-2xl p-xl">
            <form method="POST" action="{{ route('domains.update', $domain) }}" class="space-y-lg">
                @csrf
                @method('PATCH')

                <!-- Domain Name -->
                <div class="space-y-sm">
                    <label class="label-base" for="name">
                        Domain Name
                        <span class="text-error ml-0.5">*</span>
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $domain->name) }}"
                        required
                        autofocus
                        placeholder="e.g. Laravel, MySQL, Docker..."
                        class="input-base {{ $errors->has('name') ? 'border-error focus:ring-error' : '' }}"
                    />
                    @error('name')
                        <p class="text-error text-body-sm flex items-center gap-xs mt-xs">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="space-y-sm">
                    <label class="label-base" for="category">Category</label>
                    <div class="relative">
                        <select
                            id="category"
                            name="category"
                            class="input-base appearance-none pr-xl {{ $errors->has('category') ? 'border-error focus:ring-error' : '' }}"
                        >
                            <option value="">— Select a category —</option>
                            @foreach ([
                                'backend'  => 'Backend',
                                'frontend' => 'Frontend',
                                'devops'   => 'DevOps',
                                'database' => 'Database',
                                'security' => 'Security',
                                'other'    => 'Other',
                            ] as $value => $label)
                                <option value="{{ $value }}" {{ old('category', $domain->category) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px] pointer-events-none">expand_more</span>
                    </div>
                    @error('category')
                        <p class="text-error text-body-sm flex items-center gap-xs mt-xs">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Color Picker -->
                <div class="space-y-sm">
                    <label class="label-base">Domain Color</label>
                    <div class="flex items-center gap-md flex-wrap">
                        <div class="flex gap-sm flex-wrap">
                            @foreach(['#6750a4', '#7c3aed', '#0ea5e9', '#10b981', '#f59e0b', '#ef4444', '#ec4899', '#8b5cf6'] as $swatch)
                                <button type="button"
                                    onclick="setColor('{{ $swatch }}')"
                                    class="color-swatch w-7 h-7 rounded-full border-2 border-transparent hover:scale-110 transition-transform"
                                    style="background-color: {{ $swatch }}; {{ old('color', $domain->color) === $swatch ? 'border-color: ' . $swatch : '' }}"
                                    title="{{ $swatch }}"
                                ></button>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-sm flex-1">
                            <input type="color" id="color_picker" value="{{ old('color', $domain->color) }}"
                                class="w-10 h-10 rounded-lg border border-outline-variant cursor-pointer bg-transparent"
                                oninput="setColor(this.value)"
                            />
                            <input id="color_hex" type="text" name="color" value="{{ old('color', $domain->color) }}"
                                placeholder="#6750a4"
                                class="input-base font-code text-body-sm max-w-[120px]"
                                oninput="syncHex(this.value)"
                            />
                        </div>
                    </div>
                    @error('color')
                        <p class="text-error text-body-sm flex items-center gap-xs mt-xs">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-md border-t border-outline-variant">
                    <a href="{{ route('domains.index') }}" class="btn-ghost">Cancel</a>
                    <button type="submit" class="btn-primary flex items-center gap-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function setColor(hex) {
                document.getElementById('color_picker').value = hex;
                document.getElementById('color_hex').value = hex;
            }
            function syncHex(val) {
                if (/^#[0-9A-Fa-f]{6}$/.test(val)) {
                    document.getElementById('color_picker').value = val;
                }
            }
        </script>
    @endpush
</x-app-layout>
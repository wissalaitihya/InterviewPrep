<x-app-layout>
    <div class="p-md md:p-2xl">
        <div class="max-w-container-max mx-auto">
            <!-- Page Header & Actions -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-md mb-xl">
                <div>
                    <h2 class="font-h1 text-h1 text-on-surface">Technical Domains</h2>
                    <p class="text-on-surface-variant mt-xs">Manage your core competencies and interview preparations.
                    </p>
                </div>
                <div class="flex items-center gap-md">
                    <div class="relative w-full md:w-64">
                        <span
                            class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                        <input class="input-base pl-xl pr-sm" placeholder="Filter domains..." type="text"
                            id="domain-search" />
                        <div
                            class="absolute right-sm top-1/2 -translate-y-1/2 bg-surface-variant rounded px-xs py-[2px] text-on-surface-variant text-[10px] font-code">
                            ⌘F</div>
                    </div>
                    <a href="{{ route('domains.archived') }}"
                        class="btn-ghost flex items-center gap-xs px-md py-sm rounded-lg text-body-sm whitespace-nowrap border border-outline-variant hover:bg-surface-container-highest transition-colors">
                        <span class="material-symbols-outlined text-[18px]">archive</span>
                        Archives
                    </a>
                    <a href="{{ route('domains.create') }}"
                        class="ai-gradient-bg text-on-surface px-md py-sm rounded-lg font-medium hover:opacity-90 transition-opacity flex items-center gap-sm whitespace-nowrap shadow-[0_4px_12px_rgba(103,80,164,0.3)]">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        <span>Create Domain</span>
                    </a>
                </div>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('success')" />

            <!-- Domains Grid -->
            @if ($domains->isEmpty())
                <div class="glass-panel rounded-xl p-lg text-center">
                    <p class="text-on-surface-variant mb-4">No domains yet. Start by creating your first domain!</p>
                    <a href="{{ route('domains.create') }}" class="btn-primary inline-flex items-center gap-sm">
                        <span class="material-symbols-outlined">add</span>
                        Create Domain
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">
                    @foreach ($domains as $domain)
                        <div class="glass-panel rounded-xl p-md flex flex-col gap-md hover:border-primary/50 transition-colors group relative overflow-hidden domain-card"
                            data-domain-name="{{ strtolower($domain->name) }}">
                            <div
                                class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>

                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <span
                                        class="inline-block px-xs py-[2px] rounded text-label-caps text-label-caps mb-sm border"
                                        style="background-color: {{ $domain->color }}20; color: {{ $domain->color }}; border-color: {{ $domain->color }}40;">
                                        {{ strtoupper($domain->category ?? 'OTHER') }}
                                    </span>
                                    <h3 class="font-h3 text-h3 text-on-surface">{{ $domain->name }}</h3>
                                </div>
                                <div class="dropdown relative">
                                    <button
                                        class="text-on-surface-variant hover:text-primary transition-colors opacity-0 group-hover:opacity-100 p-1"
                                        type="button" id="menu-{{ $domain->id }}">
                                        <span class="material-symbols-outlined">more_vert</span>
                                    </button>
                                    <div class="absolute right-0 mt-2 w-48 bg-surface-container border border-outline-variant rounded-lg shadow-lg z-10 hidden"
                                        id="menu-content-{{ $domain->id }}">
                                        <a href="{{ route('domains.edit', $domain) }}"
                                            class="flex items-center gap-2 px-4 py-2 text-on-surface hover:bg-surface-container-high transition-colors first:rounded-t-lg">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('domains.destroy', $domain) }}" class="block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full text-left flex items-center gap-2 px-4 py-2 text-error hover:bg-error/10 transition-colors last:rounded-b-lg"
                                                onclick="return confirm('Delete this domain and all its concepts?')">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-sm text-on-surface-variant font-body-sm text-body-sm">
                                <span>{{ $domain->concepts_count }} Concepts</span>
                                <span class="text-[10px]">•</span>
                                <span>{{ $domain->mastered_concepts_count }} Mastered</span>
                            </div>

                            <div class="space-y-xs mt-auto">
                                <div class="flex justify-between text-xs text-on-surface-variant">
                                    <span>Progress</span>
                                    <span class="text-primary font-code">
                                        @php
                                            $progress = $domain->concepts_count > 0 ? round(($domain->mastered_concepts_count / $domain->concepts_count) * 100) : 0;
                                        @endphp
                                        {{ $progress }}%
                                    </span>
                                </div>
                                <div class="h-1 w-full bg-surface-container-highest rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-sm pt-sm border-t border-outline-variant/50 mt-sm">
                                <a href="{{ route('domains.edit', $domain) }}"
                                    class="p-sm rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors"
                                    title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <a href="{{ route('domains.concepts.index', $domain) }}"
                                    class="p-sm rounded-lg text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors"
                                    title="View Concepts">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="{{ route('domains.concepts.index', $domain) }}"
                                    class="p-sm rounded-lg text-tertiary hover:bg-tertiary/10 transition-colors"
                                    title="AI Generate Questions">
                                    <span class="material-symbols-outlined text-[18px]">auto_awesome</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            // Search functionality
            document.getElementById('domain-search')?.addEventListener('input', function (e) {
                const searchTerm = e.target.value.toLowerCase();
                document.querySelectorAll('.domain-card').forEach(card => {
                    const name = card.dataset.domainName;
                    card.style.display = name.includes(searchTerm) ? '' : 'none';
                });
            });

            // Dropdown menu functionality
            document.querySelectorAll('[id^="menu-"]').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.id.replace('menu-', '');
                    const menu = document.getElementById('menu-content-' + id);
                    menu.classList.toggle('hidden');
                });
            });

            document.addEventListener('click', function (e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('[id^="menu-content-"]').forEach(menu => {
                        menu.classList.add('hidden');
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
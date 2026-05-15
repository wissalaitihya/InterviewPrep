<x-app-layout>
    <div class="p-md md:p-2xl max-w-container-max mx-auto w-full space-y-lg">

        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-md mb-xl">
            <div class="flex items-center gap-md">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-surface-container-highest to-surface-container-low border border-outline-variant flex items-center justify-center shadow-lg">
                    <span class="material-symbols-outlined text-on-surface-variant text-[28px]" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
                </div>
                <div>
                    <h2 class="font-h1 text-h1 text-on-surface">Global Archive</h2>
                    <p class="text-on-surface-variant mt-xs">All archived concepts across your technical domains.</p>
                </div>
            </div>
            
            <div class="flex items-center gap-md">
                <div class="relative w-full md:w-64">
                    <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input class="input-base pl-xl pr-sm" placeholder="Filter archive..." type="text" id="archive-search" />
                </div>
            </div>
        </div>

        {{-- Toast Status --}}
        <x-auth-session-status class="mb-4" :status="session('success')" />

        {{-- Global Archives List --}}
        @if ($concepts->isEmpty())
            <div class="glass-panel rounded-2xl p-2xl flex flex-col items-center justify-center text-center border-dashed">
                <div class="w-20 h-20 rounded-full bg-surface-container flex items-center justify-center mb-xl">
                    <span class="material-symbols-outlined text-on-surface-variant text-[40px]">archive</span>
                </div>
                <h3 class="font-h2 text-h2 text-on-surface mb-sm">Your archive is empty</h3>
                <p class="text-on-surface-variant text-body-lg max-w-sm mb-xl">
                    Concepts you archive will appear here. You can manage them individually or restore them to their original domains.
                </p>
                <a href="{{ route('dashboard') }}" class="btn-primary flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[18px]">dashboard</span>
                    Return to Dashboard
                </a>
            </div>
        @else
            <div class="glass-panel rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-outline-variant bg-surface-container-low/50">
                            <tr>
                                <th class="px-lg py-md text-left text-label-caps text-on-surface-variant">Concept</th>
                                <th class="px-lg py-md text-left text-label-caps text-on-surface-variant">Original Domain</th>
                                <th class="px-lg py-md text-center text-label-caps text-on-surface-variant">Difficulty</th>
                                <th class="px-lg py-md text-left text-label-caps text-on-surface-variant">Archived Date</th>
                                <th class="px-lg py-md text-right text-label-caps text-on-surface-variant">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach ($concepts as $concept)
                                <tr class="hover:bg-surface-container-highest/30 transition-colors group archive-row" data-concept-title="{{ strtolower($concept->title) }}">
                                    {{-- Concept Title --}}
                                    <td class="px-lg py-md">
                                        <div class="flex flex-col">
                                            <span class="text-on-surface font-semibold text-body-md">{{ $concept->title }}</span>
                                            <span class="text-[11px] text-on-surface-variant/70 mt-0.5">ID: #{{ $concept->id }}</span>
                                        </div>
                                    </td>

                                    {{-- Original Domain --}}
                                    <td class="px-lg py-md">
                                        @if ($concept->domain)
                                            <div class="flex items-center gap-xs">
                                                <div class="w-2 h-2 rounded-full" style="background-color: {{ $concept->domain->color }}"></div>
                                                <span class="text-on-surface-variant text-body-sm font-medium">{{ $concept->domain->name }}</span>
                                            </div>
                                        @else
                                            <span class="badge badge-neutral text-[10px]">Deleted Domain</span>
                                        @endif
                                    </td>

                                    {{-- Difficulty --}}
                                    <td class="px-lg py-md text-center">
                                        @php
                                            $diffClass = [
                                                'junior' => 'badge-primary',
                                                'mid'    => 'badge-secondary',
                                                'senior' => 'badge-tertiary',
                                            ][$concept->difficulty] ?? 'badge-neutral';
                                        @endphp
                                        <span class="badge {{ $diffClass }} text-[10px]">
                                            {{ ucfirst($concept->difficulty ?? 'N/A') }}
                                        </span>
                                    </td>

                                    {{-- Archived Date --}}
                                    <td class="px-lg py-md text-on-surface-variant text-body-sm">
                                        <span title="{{ $concept->deleted_at?->format('M d, Y H:i:s') }}">
                                            {{ $concept->deleted_at?->format('M d, Y') }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-lg py-md text-right">
                                        <div class="flex items-center justify-end gap-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                            {{-- Restore --}}
                                            <form method="POST" action="{{ route('archives.restore', $concept->id) }}">
                                                @csrf
                                                <button type="submit" 
                                                    class="p-2 rounded-lg text-primary hover:bg-primary/10 transition-colors"
                                                    title="Restore concept">
                                                    <span class="material-symbols-outlined text-[20px]">settings_backup_restore</span>
                                                </button>
                                            </form>

                                            {{-- Permanent Delete --}}
                                            <form method="POST" action="{{ route('archives.destroy', $concept->id) }}" onsubmit="return confirm('Permanently delete this concept? This cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="p-2 rounded-lg text-error hover:bg-error/10 transition-colors"
                                                    title="Delete permanently">
                                                    <span class="material-symbols-outlined text-[20px]">delete_forever</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.getElementById('archive-search')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.archive-row').forEach(row => {
                const title = row.getAttribute('data-concept-title');
                row.style.display = title.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
    @endpush
</x-app-layout>
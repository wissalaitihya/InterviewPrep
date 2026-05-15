<x-app-layout>
    <div class="p-md md:p-2xl max-w-4xl mx-auto w-full space-y-lg">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-xs text-on-surface-variant text-body-sm flex-wrap">
            <a href="{{ route('domains.index') }}" class="hover:text-primary transition-colors flex items-center gap-xs">
                <span class="material-symbols-outlined text-[16px]">category</span>
                Domains
            </a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a href="{{ route('domains.concepts.index', $domain->id) }}" class="hover:text-primary transition-colors">
                {{ $domain->name }}
            </a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-on-surface font-medium">Archived Concepts</span>
        </div>

        {{-- Page Header --}}
        <div class="flex items-center justify-between gap-md">
            <div class="flex items-center gap-md">
                <div class="w-10 h-10 rounded-xl bg-on-surface-variant/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]" style="font-variation-settings: 'FILL' 1;">archive</span>
                </div>
                <div>
                    <h2 class="font-h1 text-h1 text-on-surface">Archived Concepts</h2>
                    <p class="text-on-surface-variant text-body-sm mt-xs">
                        Archived from <span class="font-medium" style="color: {{ $domain->color }}">{{ $domain->name }}</span>
                        · {{ $concepts->count() }} {{ Str::plural('concept', $concepts->count()) }}
                    </p>
                </div>
            </div>
            <a href="{{ route('domains.concepts.index', $domain->id) }}"
                class="btn-ghost flex items-center gap-sm text-body-sm">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Back to Concepts
            </a>
        </div>

        {{-- Empty State --}}
        @if ($concepts->isEmpty())
            <div class="glass-panel rounded-2xl p-2xl flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-2xl bg-surface-container flex items-center justify-center mb-lg">
                    <span class="material-symbols-outlined text-on-surface-variant text-[32px]">inventory_2</span>
                </div>
                <h3 class="font-h3 text-h3 text-on-surface mb-sm">No archived concepts</h3>
                <p class="text-on-surface-variant text-body-sm max-w-sm mb-xl">
                    Archived concepts from this domain will appear here. You can restore them at any time.
                </p>
                <a href="{{ route('domains.concepts.index', $domain->id) }}" class="btn-primary flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Back to Active Concepts
                </a>
            </div>
        @else
            {{-- Concepts Table --}}
            <div class="glass-panel rounded-2xl overflow-hidden">
                <div class="px-lg py-md border-b border-outline-variant bg-surface-container-lowest/50 flex items-center justify-between">
                    <p class="text-on-surface-variant text-body-sm">
                        <span class="material-symbols-outlined text-[14px] align-middle mr-xs" style="font-variation-settings: 'FILL' 1;">info</span>
                        Archived concepts are hidden from your active study list. Restore them to continue learning.
                    </p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-outline-variant">
                            <tr>
                                <th class="px-lg py-md text-left text-label-caps text-on-surface-variant">Concept</th>
                                <th class="px-lg py-md text-center text-label-caps text-on-surface-variant">Difficulty</th>
                                <th class="px-lg py-md text-center text-label-caps text-on-surface-variant">Last Status</th>
                                <th class="px-lg py-md text-left text-label-caps text-on-surface-variant">Archived</th>
                                <th class="px-lg py-md text-right text-label-caps text-on-surface-variant">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach ($concepts as $concept)
                                <tr class="hover:bg-surface-container-highest/30 transition-colors group">
                                    {{-- Title --}}
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-sm">
                                            <div class="w-8 h-8 rounded-lg bg-on-surface-variant/10 flex items-center justify-center flex-shrink-0">
                                                <span class="material-symbols-outlined text-on-surface-variant text-[16px]">archive</span>
                                            </div>
                                            <span class="text-on-surface-variant font-medium text-body-md line-through decoration-on-surface-variant/40">
                                                {{ $concept->title }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Difficulty --}}
                                    <td class="px-lg py-md text-center">
                                        <span class="badge
                                            {{ $concept->difficulty === 'junior' ? 'badge-primary' : '' }}
                                            {{ $concept->difficulty === 'mid' ? 'badge-secondary' : '' }}
                                            {{ $concept->difficulty === 'senior' ? 'badge-tertiary' : '' }}">
                                            {{ ucfirst($concept->difficulty ?? 'unknown') }}
                                        </span>
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-lg py-md text-center">
                                        <span class="badge badge-neutral opacity-70">
                                            {{ ucfirst(str_replace('_', ' ', $concept->status ?? 'unknown')) }}
                                        </span>
                                    </td>

                                    {{-- Archived date --}}
                                    <td class="px-lg py-md text-body-sm text-on-surface-variant">
                                        <span title="{{ $concept->deleted_at?->format('M d, Y H:i') }}">
                                            {{ $concept->deleted_at?->diffForHumans() ?? 'Unknown' }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-lg py-md text-right">
                                        <form method="POST"
                                            action="{{ route('concepts.restore', [$domain->id, $concept->id]) }}"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-xs px-sm py-xs rounded-lg text-primary border border-primary/20 hover:bg-primary/10 transition-all duration-150 text-body-sm font-medium">
                                                <span class="material-symbols-outlined text-[16px]">restore</span>
                                                Restore
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
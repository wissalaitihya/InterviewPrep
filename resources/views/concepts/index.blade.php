<x-app-layout>
    <div class="p-md md:p-2xl">
        <div class="max-w-container-max mx-auto">
            <!-- Breadcrumb & Header -->
            <div class="flex justify-between items-center mb-xl">
                <div class="flex items-center gap-sm text-on-surface-variant font-body-sm text-body-sm">
                    <a href="{{ route('domains.index') }}" class="hover:text-on-surface transition-colors">Domains</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="text-on-surface font-body-md">{{ $domain->name }}</span>
                </div>
                <div class="flex gap-md">
                    <a href="{{ route('concepts.archived', $domain->id) }}"
                        class="btn-ghost px-md py-sm rounded-lg font-body-sm flex items-center gap-sm">
                        <span class="material-symbols-outlined">archive</span>
                        Archives
                    </a>
                    <a href="{{ route('domains.concepts.create', $domain->id) }}"
                        class="btn-primary px-md py-sm rounded-lg font-body-sm flex items-center gap-sm">
                        <span class="material-symbols-outlined">add</span>
                        Add Concept
                    </a>
                </div>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('success')" />

            <!-- Filters -->
            <div class="glass-panel rounded-xl p-lg mb-md">
                <form method="GET" action="{{ route('domains.concepts.index', $domain->id) }}"
                    class="flex gap-4 items-end flex-wrap">
                    <div>
                        <label class="label-base mb-sm" for="status">Status</label>
                        <select name="status" id="status" class="input-base text-body-sm" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="to_review" {{ request('status') == 'to_review' ? 'selected' : '' }}>To Review
                            </option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="mastered" {{ request('status') == 'mastered' ? 'selected' : '' }}>Mastered
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="label-base mb-sm" for="difficulty">Difficulty</label>
                        <select name="difficulty" id="difficulty" class="input-base text-body-sm"
                            onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="junior" {{ request('difficulty') == 'junior' ? 'selected' : '' }}>Junior
                            </option>
                            <option value="mid" {{ request('difficulty') == 'mid' ? 'selected' : '' }}>Mid</option>
                            <option value="senior" {{ request('difficulty') == 'senior' ? 'selected' : '' }}>Senior
                            </option>
                        </select>
                    </div>
                    @if(request('status') || request('difficulty'))
                        <a href="{{ route('domains.concepts.index', $domain->id) }}"
                            class="text-primary hover:text-primary-fixed transition-colors font-body-sm pb-1">Clear
                            Filters</a>
                    @endif
                </form>
            </div>

            <!-- Concepts Table -->
            @if ($concepts->isEmpty())
                <div class="glass-panel rounded-xl p-lg text-center">
                    <p class="text-on-surface-variant mb-4">No concepts for this domain yet.</p>
                    <a href="{{ route('domains.concepts.create', $domain->id) }}"
                        class="btn-primary inline-flex items-center gap-sm">
                        <span class="material-symbols-outlined">add</span>
                        Create First Concept
                    </a>
                </div>
            @else
                <div class="glass-panel rounded-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b border-outline-variant">
                                <tr>
                                    <th class="px-lg py-md text-left text-label-caps text-on-surface-variant">Title</th>
                                    <th class="px-lg py-md text-center text-label-caps text-on-surface-variant">Difficulty
                                    </th>
                                    <th class="px-lg py-md text-center text-label-caps text-on-surface-variant">Status</th>
                                    <th class="px-lg py-md text-right text-label-caps text-on-surface-variant">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @foreach ($concepts as $concept)
                                    <tr class="hover:bg-surface-container-highest/50 transition-colors">
                                        <td class="px-lg py-md">
                                            <a href="{{ route('domains.concepts.show', [$domain->id, $concept->id]) }}"
                                                class="text-on-surface hover:text-primary font-body-md transition-colors">
                                                {{ $concept->title }}
                                            </a>
                                        </td>
                                        <td class="px-lg py-md text-center">
                                            <span
                                                class="inline-flex items-center px-xs py-xs rounded-full text-label-caps font-medium
                                                                                {{ $concept->difficulty === 'junior' ? 'bg-primary/10 text-primary' : '' }}
                                                                                {{ $concept->difficulty === 'mid' ? 'bg-secondary/10 text-secondary' : '' }}
                                                                                {{ $concept->difficulty === 'senior' ? 'bg-tertiary/10 text-tertiary' : '' }}">
                                                {{ ucfirst($concept->difficulty ?? 'unknown') }}
                                            </span>
                                        </td>
                                        <td class="px-lg py-md text-center">
                                            <span
                                                class="inline-flex items-center px-xs py-xs rounded-full text-label-caps font-medium
                                                                                {{ $concept->status === 'to_review' ? 'bg-error/10 text-error' : '' }}
                                                                                {{ $concept->status === 'in_progress' ? 'bg-tertiary/10 text-tertiary' : '' }}
                                                                                {{ $concept->status === 'mastered' ? 'bg-primary/10 text-primary' : '' }}">
                                                {{ ucfirst($concept->status ?? 'unknown') }}
                                            </span>
                                        </td>
                                        <td class="px-lg py-md text-right space-x-sm">
                                            <form method="POST"
                                                action="{{ route('concepts.toggle-status', [$domain->id, $concept->id]) }}"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="text-on-surface-variant hover:text-primary transition-colors font-body-sm"
                                                    title="Toggle status">
                                                    <span class="material-symbols-outlined text-[18px]">repeat</span>
                                                </button>
                                            </form>
                                            <a href="{{ route('domains.concepts.edit', [$domain->id, $concept->id]) }}"
                                                class="text-on-surface-variant hover:text-primary transition-colors font-body-sm inline-block"
                                                title="Edit">
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                            </a>
                                            <form method="POST"
                                                action="{{ route('domains.concepts.destroy', [$domain->id, $concept->id]) }}"
                                                class="inline" onsubmit="return confirm('Archive this concept?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-error hover:text-error/80 transition-colors font-body-sm"
                                                    title="Archive">
                                                    <span class="material-symbols-outlined text-[18px]">delete</span>
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
    </div>
</x-app-layout>
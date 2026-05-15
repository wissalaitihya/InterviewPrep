<x-app-layout>
    <div class="p-md md:p-2xl max-w-4xl mx-auto w-full space-y-lg">

        {{-- ─── Flash Messages ─── --}}
        @if (session('success'))
            <div class="rounded-xl p-lg bg-primary/10 border border-primary/20 text-primary font-medium text-body-sm flex items-center gap-sm">
                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="rounded-xl p-lg bg-error/10 border border-error/20 text-error font-medium text-body-sm flex items-center gap-sm">
                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">error</span>
                {{ session('error') }}
            </div>
        @endif

        {{-- ─── Breadcrumb ─── --}}
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
            <span class="text-on-surface font-medium truncate max-w-[200px]">{{ $concept->title }}</span>
        </div>

        {{-- ─── Concept Header Card ─── --}}
        <div class="glass-panel rounded-2xl overflow-hidden">
            {{-- Top accent bar with domain color --}}
            <div class="h-1 w-full" style="background: linear-gradient(to right, {{ $domain->color }}, {{ $domain->color }}60)"></div>

            <div class="p-xl">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-lg">
                    {{-- Left: Title + badges --}}
                    <div class="flex-1">
                        {{-- Domain pill --}}
                        <span class="inline-flex items-center gap-xs px-sm py-xs rounded-lg text-label-caps font-medium border mb-md"
                            style="background-color: {{ $domain->color }}15; color: {{ $domain->color }}; border-color: {{ $domain->color }}35;">
                            <span class="w-2 h-2 rounded-full inline-block" style="background-color: {{ $domain->color }}"></span>
                            {{ strtoupper($domain->category ?? 'DOMAIN') }} · {{ $domain->name }}
                        </span>

                        <h1 class="font-display text-h1 font-bold text-on-surface tracking-tight mb-lg">
                            {{ $concept->title }}
                        </h1>

                        {{-- Status + Difficulty badges --}}
                        <div class="flex flex-wrap items-center gap-sm">
                            {{-- Status badge --}}
                            @php
                                $statusConfig = [
                                    'to_review'   => ['label' => 'To Review',    'icon' => 'schedule',  'class' => 'bg-error/10 text-error border-error/20'],
                                    'in_progress' => ['label' => 'In Progress',  'icon' => 'autorenew', 'class' => 'bg-tertiary/10 text-tertiary border-tertiary/20'],
                                    'mastered'    => ['label' => 'Mastered',     'icon' => 'verified',  'class' => 'bg-primary/10 text-primary border-primary/20'],
                                ];
                                $st = $statusConfig[$concept->status] ?? $statusConfig['to_review'];
                                $diffConfig = [
                                    'junior' => ['label' => 'Junior', 'class' => 'bg-primary/10 text-primary border-primary/20'],
                                    'mid'    => ['label' => 'Mid',    'class' => 'bg-secondary/10 text-secondary border-secondary/20'],
                                    'senior' => ['label' => 'Senior', 'class' => 'bg-tertiary/10 text-tertiary border-tertiary/20'],
                                ];
                                $df = $diffConfig[$concept->difficulty] ?? $diffConfig['junior'];
                            @endphp

                            <span class="inline-flex items-center gap-xs px-sm py-xs rounded-full text-label-caps font-semibold border {{ $st['class'] }}">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">{{ $st['icon'] }}</span>
                                {{ $st['label'] }}
                            </span>
                            <span class="inline-flex items-center gap-xs px-sm py-xs rounded-full text-label-caps font-semibold border {{ $df['class'] }}">
                                {{ $df['label'] }}
                            </span>
                            <span class="text-on-surface-variant text-body-sm">
                                Added {{ $concept->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                    {{-- Right: Action buttons --}}
                    <div class="flex flex-wrap gap-sm md:flex-col md:items-end flex-shrink-0">
                        {{-- Toggle status --}}
                        <form method="POST" action="{{ route('concepts.toggle-status', [$domain->id, $concept->id]) }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-sm px-md py-sm rounded-xl text-body-sm font-medium border transition-all duration-150
                                    {{ $concept->status === 'mastered'
                                        ? 'bg-error/10 text-error border-error/20 hover:bg-error/20'
                                        : 'bg-primary/10 text-primary border-primary/20 hover:bg-primary/20' }}">
                                <span class="material-symbols-outlined text-[18px]">
                                    {{ $concept->status === 'mastered' ? 'remove_done' : 'check_circle' }}
                                </span>
                                {{ $concept->status === 'mastered' ? 'Mark Unlearned' : 'Advance Status' }}
                            </button>
                        </form>

                        {{-- Edit --}}
                        <a href="{{ route('domains.concepts.edit', [$domain->id, $concept->id]) }}"
                            class="flex items-center gap-sm px-md py-sm rounded-xl text-body-sm font-medium border border-outline-variant hover:bg-surface-container-highest text-on-surface-variant hover:text-on-surface transition-all duration-150">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                            Edit
                        </a>

                        {{-- Archive --}}
                        <form method="POST" action="{{ route('domains.concepts.destroy', [$domain->id, $concept->id]) }}"
                            onsubmit="return confirm('Archive this concept?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-sm px-md py-sm rounded-xl text-body-sm font-medium border border-outline-variant text-error/70 hover:bg-error/10 hover:border-error/30 hover:text-error transition-all duration-150">
                                <span class="material-symbols-outlined text-[18px]">archive</span>
                                Archive
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── Explanation / Revision Notes ─── --}}
        <div class="glass-panel rounded-2xl p-xl">
            <h2 class="font-h3 text-h3 text-on-surface flex items-center gap-sm mb-lg">
                <span class="w-7 h-7 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-primary text-[16px]" style="font-variation-settings: 'FILL' 1;">notes</span>
                </span>
                Revision Notes
            </h2>
            <div class="text-on-surface text-body-md leading-relaxed whitespace-pre-wrap bg-surface-container-lowest rounded-xl p-lg border border-outline-variant/50 font-body-md">
                {{ $concept->explanation }}
            </div>
        </div>

        {{-- ─── AI Question Generator ─── --}}
        <div class="glass-panel rounded-2xl overflow-hidden">
            {{-- Header --}}
            <div class="px-xl pt-xl pb-lg border-b border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-md">
                <div>
                    <h2 class="font-h3 text-h3 text-on-surface flex items-center gap-sm">
                        <span class="w-7 h-7 rounded-lg bg-secondary/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                        </span>
                        AI Interview Questions
                    </h2>
                    <p class="text-on-surface-variant text-body-sm mt-xs">
                        Generate targeted interview questions for this concept using Groq AI.
                    </p>
                </div>

                {{-- Generate CTA --}}
                <form method="POST" action="{{ route('concepts.generate', [$domain->id, $concept->id]) }}" id="generate-form">
                    @csrf
                    <button type="submit" id="generate-btn"
                        class="flex items-center gap-sm px-lg py-sm rounded-xl font-medium text-body-sm
                               bg-gradient-to-r from-primary-container to-secondary-container text-on-primary-container
                               hover:opacity-90 transition-all duration-200 shadow-lg hover:shadow-primary/20 hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-[18px]" id="generate-icon" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                        <span id="generate-label">Generate Questions</span>
                    </button>
                </form>
            </div>

            {{-- Loading State (shown on submit) --}}
            <div id="ai-loading" class="hidden px-xl py-lg">
                <div class="flex flex-col items-center justify-center gap-lg py-xl">
                    <div class="relative w-16 h-16">
                        <div class="absolute inset-0 rounded-full border-2 border-primary/20 animate-ping"></div>
                        <div class="absolute inset-0 rounded-full border-2 border-transparent border-t-primary animate-spin"></div>
                        <div class="absolute inset-2 rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-[20px]" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="font-h3 text-h3 text-on-surface mb-xs">Generating questions...</p>
                        <p class="text-on-surface-variant text-body-sm">Groq AI is crafting targeted interview questions for <strong>{{ $concept->title }}</strong></p>
                    </div>
                    <div class="flex gap-xs">
                        @foreach(['Analyzing concept...', 'Generating questions...', 'Formatting output...'] as $step)
                            <span class="px-sm py-xs rounded-full text-label-caps bg-surface-container border border-outline-variant text-on-surface-variant">
                                {{ $step }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Generation History --}}
            <div class="p-xl">
                @if ($concept->generatedQuestions->isEmpty())
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center py-2xl text-center">
                        <div class="w-16 h-16 rounded-2xl bg-surface-container flex items-center justify-center mb-lg">
                            <span class="material-symbols-outlined text-on-surface-variant text-[32px]">quiz</span>
                        </div>
                        <h3 class="font-h3 text-h3 text-on-surface mb-sm">No questions yet</h3>
                        <p class="text-on-surface-variant text-body-sm max-w-sm">
                            Click "Generate Questions" above to let Groq AI create targeted interview questions based on your revision notes.
                        </p>
                    </div>
                @else
                    <h3 class="font-h3 text-h3 text-on-surface mb-lg flex items-center gap-sm">
                        Generation History
                        <span class="text-label-caps font-semibold text-on-surface-variant bg-surface-container border border-outline-variant px-sm py-xs rounded-full">
                            {{ $concept->generatedQuestions->count() }} {{ Str::plural('session', $concept->generatedQuestions->count()) }}
                        </span>
                    </h3>

                    <div class="space-y-lg">
                        @foreach ($concept->generatedQuestions as $gq)
                            <div class="glass-panel rounded-xl overflow-hidden group">
                                {{-- Generation header --}}
                                <div class="flex items-center justify-between px-lg py-md border-b border-outline-variant bg-surface-container-lowest/50">
                                    <div class="flex items-center gap-sm">
                                        <div class="w-6 h-6 rounded-lg bg-secondary/10 flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-secondary text-[14px]" style="font-variation-settings: 'FILL' 1;">smart_toy</span>
                                        </div>
                                        <div>
                                            <p class="text-on-surface font-medium text-body-sm">AI Generation</p>
                                            <p class="text-on-surface-variant text-[11px]">
                                                {{ $gq->created_at->format('M d, Y · H:i') }} — {{ $gq->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-sm">
                                        <span class="text-label-caps text-on-surface-variant bg-surface-container rounded-full px-sm py-xs border border-outline-variant">
                                            {{ count($gq->questions ?? []) }} {{ Str::plural('question', count($gq->questions ?? [])) }}
                                        </span>
                                        <form method="POST" action="{{ route('generated-questions.destroy', $gq->id) }}"
                                            onsubmit="return confirm('Delete this generation?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="opacity-0 group-hover:opacity-100 p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error/10 transition-all duration-150"
                                                title="Delete generation">
                                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                {{-- Questions list --}}
                                <ul class="p-lg space-y-sm">
                                    @foreach ($gq->questions as $index => $q)
                                        <li class="flex gap-sm group/q hover:bg-surface-container-highest/30 rounded-lg px-sm py-sm -mx-sm transition-colors">
                                            <span class="font-code text-label-caps text-primary bg-primary/10 rounded-md px-xs py-xs flex-shrink-0 min-w-[28px] text-center h-fit mt-0.5">
                                                {{ $loop->iteration }}
                                            </span>
                                            <p class="text-on-surface text-body-md leading-relaxed">{{ $q }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('generate-form')?.addEventListener('submit', function () {
                // Show loading state
                document.getElementById('ai-loading').classList.remove('hidden');
                document.getElementById('generate-btn').disabled = true;
                document.getElementById('generate-btn').classList.add('opacity-60', 'cursor-not-allowed');
                document.getElementById('generate-icon').textContent = 'hourglass_empty';
                document.getElementById('generate-label').textContent = 'Generating...';
            });
        </script>
    @endpush
</x-app-layout>
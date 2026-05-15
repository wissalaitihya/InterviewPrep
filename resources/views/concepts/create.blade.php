<x-app-layout>
    <div class="p-md md:p-2xl max-w-2xl mx-auto w-full">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-xs text-on-surface-variant text-body-sm mb-xl flex-wrap">
            <a href="{{ route('domains.index') }}" class="hover:text-primary transition-colors flex items-center gap-xs">
                <span class="material-symbols-outlined text-[16px]">category</span>
                Domains
            </a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a href="{{ route('domains.concepts.index', $domain->id) }}" class="hover:text-primary transition-colors">
                {{ $domain->name }}
            </a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-on-surface font-medium">New Concept</span>
        </div>

        <!-- Page Header -->
        <div class="mb-xl flex items-start gap-md">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                style="background-color: {{ $domain->color }}20;">
                <span class="material-symbols-outlined text-[20px]" style="color: {{ $domain->color }}">lightbulb</span>
            </div>
            <div>
                <h2 class="font-h1 text-h1 text-on-surface">New Concept</h2>
                <p class="text-on-surface-variant mt-xs">
                    Adding to <span class="font-medium" style="color: {{ $domain->color }}">{{ $domain->name }}</span>
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="glass-panel rounded-2xl p-xl">
            <form method="POST" action="{{ route('domains.concepts.store', $domain->id) }}" class="space-y-lg">
                @csrf

                <!-- Title -->
                <div class="space-y-sm">
                    <label class="label-base" for="title">
                        Concept Title
                        <span class="text-error ml-0.5">*</span>
                    </label>
                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        autofocus
                        placeholder="e.g. Dependency Injection, N+1 Problem, SOLID Principles..."
                        class="input-base {{ $errors->has('title') ? 'border-error' : '' }}"
                    />
                    @error('title')
                        <p class="text-error text-body-sm flex items-center gap-xs">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Explanation -->
                <div class="space-y-sm">
                    <label class="label-base" for="explanation">
                        Explanation / Revision Notes
                        <span class="text-error ml-0.5">*</span>
                    </label>
                    <textarea
                        id="explanation"
                        name="explanation"
                        rows="8"
                        required
                        placeholder="Write your revision notes here. Explain the concept in your own words, include examples, common pitfalls, etc."
                        class="input-base resize-y min-h-[160px] font-body-md {{ $errors->has('explanation') ? 'border-error' : '' }}"
                    >{{ old('explanation') }}</textarea>
                    @error('explanation')
                        <p class="text-error text-body-sm flex items-center gap-xs">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="text-on-surface-variant text-body-sm">
                        <span class="material-symbols-outlined text-[14px] align-middle">info</span>
                        These notes will be used by the AI to generate targeted interview questions.
                    </p>
                </div>

                <!-- Difficulty & Status row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-lg">
                    <!-- Difficulty -->
                    <div class="space-y-sm">
                        <label class="label-base" for="difficulty">Difficulty Level</label>
                        <div class="relative">
                            <select
                                id="difficulty"
                                name="difficulty"
                                required
                                class="input-base appearance-none pr-xl {{ $errors->has('difficulty') ? 'border-error' : '' }}"
                            >
                                <option value="junior" {{ old('difficulty', 'junior') === 'junior' ? 'selected' : '' }}>🟢 Junior</option>
                                <option value="mid" {{ old('difficulty') === 'mid' ? 'selected' : '' }}>🟡 Mid-Level</option>
                                <option value="senior" {{ old('difficulty') === 'senior' ? 'selected' : '' }}>🔴 Senior</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px] pointer-events-none">expand_more</span>
                        </div>
                        @error('difficulty')
                            <p class="text-error text-body-sm flex items-center gap-xs">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-sm">
                        <label class="label-base" for="status">Mastery Status</label>
                        <div class="relative">
                            <select
                                id="status"
                                name="status"
                                class="input-base appearance-none pr-xl {{ $errors->has('status') ? 'border-error' : '' }}"
                            >
                                <option value="to_review" {{ old('status', 'to_review') === 'to_review' ? 'selected' : '' }}>📋 To Review</option>
                                <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>⚡ In Progress</option>
                                <option value="mastered" {{ old('status') === 'mastered' ? 'selected' : '' }}>✅ Mastered</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px] pointer-events-none">expand_more</span>
                        </div>
                        @error('status')
                            <p class="text-error text-body-sm flex items-center gap-xs">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-md border-t border-outline-variant">
                    <a href="{{ route('domains.concepts.index', $domain->id) }}" class="btn-ghost">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary flex items-center gap-sm">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        Create Concept
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
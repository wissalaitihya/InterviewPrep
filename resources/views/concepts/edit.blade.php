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
            <a href="{{ route('domains.concepts.show', [$domain->id, $concept->id]) }}" class="hover:text-primary transition-colors truncate max-w-[150px]">
                {{ $concept->title }}
            </a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-on-surface font-medium">Edit</span>
        </div>

        <!-- Page Header -->
        <div class="mb-xl flex items-start gap-md">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                style="background-color: {{ $domain->color }}20;">
                <span class="material-symbols-outlined text-[20px]" style="color: {{ $domain->color }}">edit</span>
            </div>
            <div>
                <h2 class="font-h1 text-h1 text-on-surface">Edit Concept</h2>
                <p class="text-on-surface-variant mt-xs">Update your revision notes and mastery status.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="glass-panel rounded-2xl p-xl">
            <form method="POST" action="{{ route('domains.concepts.update', [$domain->id, $concept->id]) }}" class="space-y-lg">
                @csrf
                @method('PATCH')

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
                        value="{{ old('title', $concept->title) }}"
                        required
                        autofocus
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
                        class="input-base resize-y min-h-[160px] font-body-md {{ $errors->has('explanation') ? 'border-error' : '' }}"
                    >{{ old('explanation', $concept->explanation) }}</textarea>
                    @error('explanation')
                        <p class="text-error text-body-sm flex items-center gap-xs">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Difficulty & Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-lg">
                    <div class="space-y-sm">
                        <label class="label-base" for="difficulty">Difficulty Level</label>
                        <div class="relative">
                            <select id="difficulty" name="difficulty" required
                                class="input-base appearance-none pr-xl {{ $errors->has('difficulty') ? 'border-error' : '' }}">
                                <option value="junior" {{ old('difficulty', $concept->difficulty) === 'junior' ? 'selected' : '' }}>🟢 Junior</option>
                                <option value="mid" {{ old('difficulty', $concept->difficulty) === 'mid' ? 'selected' : '' }}>🟡 Mid-Level</option>
                                <option value="senior" {{ old('difficulty', $concept->difficulty) === 'senior' ? 'selected' : '' }}>🔴 Senior</option>
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

                    <div class="space-y-sm">
                        <label class="label-base" for="status">Mastery Status</label>
                        <div class="relative">
                            <select id="status" name="status" required
                                class="input-base appearance-none pr-xl {{ $errors->has('status') ? 'border-error' : '' }}">
                                <option value="to_review" {{ old('status', $concept->status) === 'to_review' ? 'selected' : '' }}>📋 To Review</option>
                                <option value="in_progress" {{ old('status', $concept->status) === 'in_progress' ? 'selected' : '' }}>⚡ In Progress</option>
                                <option value="mastered" {{ old('status', $concept->status) === 'mastered' ? 'selected' : '' }}>✅ Mastered</option>
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
                    <a href="{{ route('domains.concepts.show', [$domain->id, $concept->id]) }}" class="btn-ghost">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary flex items-center gap-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="mt-lg glass-panel rounded-2xl p-lg border-error/20">
            <h3 class="font-h3 text-h3 text-error flex items-center gap-sm mb-sm">
                <span class="material-symbols-outlined text-[20px]">warning</span>
                Danger Zone
            </h3>
            <p class="text-on-surface-variant text-body-sm mb-md">Archiving this concept will move it to the archive. You can restore it later.</p>
            <form method="POST" action="{{ route('domains.concepts.destroy', [$domain->id, $concept->id]) }}"
                onsubmit="return confirm('Archive this concept? You can restore it from the Archives page.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="flex items-center gap-sm px-md py-sm rounded-lg text-error border border-error/30 hover:bg-error/10 transition-all duration-150 text-body-sm font-medium">
                    <span class="material-symbols-outlined text-[18px]">archive</span>
                    Archive This Concept
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
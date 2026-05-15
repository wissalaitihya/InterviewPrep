<x-app-layout>
    <div class="p-md md:p-2xl max-w-7xl mx-auto w-full space-y-lg">
        <div>
            <a href="{{ route('domains.index') }}" class="text-sm text-on-surface-variant hover:text-primary transition-colors flex items-center gap-xs">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Back to Domains
            </a>
        </div>

        <div class="flex items-center justify-between">
            <h2 class="font-display text-h2 font-bold text-on-surface tracking-tight">Archived Domains</h2>
        </div>

        @if (session('success'))
            <div class="rounded-xl p-lg bg-primary/10 border border-primary/20 text-primary font-medium text-body-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($domains->isEmpty())
            <div class="glass-panel rounded-2xl p-xl text-center text-on-surface-variant text-body-md">
                No archived domains.
            </div>
        @else
            <div class="space-y-md">
                @foreach ($domains as $domain)
                    <div class="glass-panel rounded-2xl p-xl flex items-center justify-between opacity-60">
                        <div class="flex items-center gap-lg">
                            <span class="inline-block w-10 h-10 rounded-xl" style="background-color: {{ $domain->color }}20;">
                                <span class="flex items-center justify-center w-full h-full" style="color: {{ $domain->color }};">
                                    <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">category</span>
                                </span>
                            </span>
                            <div>
                                <h4 class="font-h3 text-h3 text-on-surface">{{ $domain->name }}</h4>
                                <p class="text-on-surface-variant text-body-sm">
                                    {{ $domain->concepts_count }} concepts · Archived {{ $domain->deleted_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-sm">
                            <form method="POST" action="{{ route('domains.restore', $domain->id) }}">
                                @csrf
                                <button type="submit" class="btn-ghost flex items-center gap-sm px-md py-sm rounded-xl text-body-sm font-medium">
                                    <span class="material-symbols-outlined text-[18px]">restore</span>
                                    Restore
                                </button>
                            </form>
                            <form method="POST" action="{{ route('domains.force-delete', $domain->id) }}"
                                onsubmit="return confirm('Permanently delete this domain and ALL its concepts?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center gap-sm px-md py-sm rounded-xl text-body-sm font-medium text-error hover:bg-error/10 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">delete_forever</span>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
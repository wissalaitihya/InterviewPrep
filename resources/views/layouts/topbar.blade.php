<!-- TopAppBar (Mobile only) -->
<header class="md:hidden flex justify-between items-center px-lg py-sm w-full sticky top-0 z-40 bg-surface/90 backdrop-blur-md border-b border-outline-variant">
    <div class="flex items-center gap-sm">
        <!-- Hamburger -->
        <button onclick="openSidebar()"
            class="p-2 hover:bg-surface-container-high transition-colors duration-200 rounded-lg text-on-surface-variant hover:text-on-surface">
            <span class="material-symbols-outlined text-[22px]">menu</span>
        </button>
        <!-- Logo -->
        <div class="flex items-center gap-xs">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-primary-container to-secondary-container flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary-container text-[14px]" style="font-variation-settings: 'FILL' 1;">psychology</span>
            </div>
            <span class="font-bold text-on-surface text-[15px] tracking-tight">DevPrep</span>
        </div>
    </div>

    <div class="flex items-center gap-xs text-on-surface-variant">
        <a href="{{ route('domains.create') }}"
            class="p-2 hover:bg-surface-container-high transition-colors duration-200 rounded-lg hover:text-primary">
            <span class="material-symbols-outlined text-[22px]">add</span>
        </a>
        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-container to-secondary-container flex items-center justify-center text-on-primary-container font-bold text-[13px]">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>
    </div>
</header>
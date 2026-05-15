<!-- SideNavBar -->
<nav id="app-sidebar"
    class="flex flex-col bg-surface-container-low text-primary font-body-sm h-screen w-64 border-r border-outline-variant fixed left-0 top-0 bottom-0 p-md z-50 overflow-y-auto
           transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">

    <!-- Logo / Brand -->
    <div class="mb-lg px-sm pt-sm">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-sm group">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-container to-secondary-container flex items-center justify-center shadow-lg flex-shrink-0">
                <span class="material-symbols-outlined text-on-primary-container text-[20px]" style="font-variation-settings: 'FILL' 1;">psychology</span>
            </div>
            <div>
                <h1 class="font-display text-[16px] font-bold text-on-surface tracking-tight leading-none">DevPrep AI</h1>
                <p class="text-on-surface-variant text-[11px] mt-0.5">Interview Engine</p>
            </div>
        </a>
    </div>

    <!-- Search Bar -->
    <button class="w-full text-left bg-surface-container border border-outline-variant text-on-surface-variant hover:text-on-surface rounded-lg px-sm py-2 flex justify-between items-center mb-md transition-all duration-150 hover:border-primary/40 group">
        <span class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[16px] group-hover:text-primary transition-colors">search</span>
            <span class="text-[13px]">Quick search...</span>
        </span>
        <kbd class="text-[10px] border border-outline-variant rounded px-1 py-0.5 text-on-surface-variant font-code">⌘K</kbd>
    </button>

    <!-- Nav Label -->
    <p class="text-[10px] font-semibold text-on-surface-variant/60 uppercase tracking-widest px-sm mb-sm">Navigation</p>

    <!-- Main Navigation -->
    <ul class="flex-1 space-y-xs">
        <li>
            <a href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]"
                    style="font-variation-settings: 'FILL' {{ request()->routeIs('dashboard') ? 1 : 0 }};">dashboard</span>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('domains.index') }}"
                class="nav-link {{ request()->routeIs('domains.*') && !request()->routeIs('domains.concepts.*') ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]"
                    style="font-variation-settings: 'FILL' {{ request()->routeIs('domains.*') && !request()->routeIs('domains.concepts.*') ? 1 : 0 }};">category</span>
                Domains
            </a>
        </li>

        <!-- Concepts sub-nav (shown when inside a domain) -->
        @if (request()->routeIs('domains.concepts.*') || request()->routeIs('concepts.*'))
            <li class="pl-md space-y-xs pt-xs">
                <p class="text-[10px] font-semibold text-on-surface-variant/50 uppercase tracking-widest px-sm mb-xs">Concepts</p>
                <a href="{{ route('domains.concepts.index', Route::current()->parameter('domain')) }}"
                    class="nav-link text-[13px] {{ request()->routeIs('domains.concepts.index') ? 'nav-link-active' : '' }}">
                    <span class="material-symbols-outlined text-[16px]">list</span>
                    All Concepts
                </a>
                <a href="{{ route('domains.concepts.create', Route::current()->parameter('domain')) }}"
                    class="nav-link text-[13px] {{ request()->routeIs('domains.concepts.create') ? 'nav-link-active' : '' }}">
                    <span class="material-symbols-outlined text-[16px]">add_circle</span>
                    New Concept
                </a>
                <a href="{{ route('concepts.archived', Route::current()->parameter('domain')) }}"
                    class="nav-link text-[13px] {{ request()->routeIs('concepts.archived') ? 'nav-link-active' : '' }}">
                    <span class="material-symbols-outlined text-[16px]">archive</span>
                    Archived
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('archives.index') }}"
                class="nav-link {{ request()->routeIs('archives.*') ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]"
                    style="font-variation-settings: 'FILL' {{ request()->routeIs('archives.*') ? 1 : 0 }};">inventory_2</span>
                Archive
            </a>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}"
                class="nav-link {{ request()->routeIs('profile.*') ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]"
                    style="font-variation-settings: 'FILL' {{ request()->routeIs('profile.*') ? 1 : 0 }};">manage_accounts</span>
                Profile
            </a>
        </li>
    </ul>

    <!-- Footer: User + Logout -->
    <div class="mt-auto pt-md border-t border-outline-variant space-y-xs">
        <!-- User Card -->
        <div class="flex items-center gap-sm px-sm py-sm rounded-lg hover:bg-surface-container-highest transition-colors cursor-pointer">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-container to-secondary-container flex items-center justify-center text-on-primary-container font-bold text-[13px] flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-on-surface font-medium text-[13px] truncate">{{ Auth::user()->name ?? 'User' }}</p>
                <p class="text-on-surface-variant text-[11px] truncate">{{ Auth::user()->email ?? '' }}</p>
            </div>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="nav-link w-full text-left text-on-surface-variant hover:text-error hover:bg-error/10 transition-all duration-150">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                Sign Out
            </button>
        </form>
    </div>
</nav>
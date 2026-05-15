<x-app-layout>
    <div class="p-md md:p-2xl max-w-3xl mx-auto w-full space-y-lg">

        {{-- Page Header --}}
        <div class="flex items-center gap-md mb-xl">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-container to-secondary-container flex items-center justify-center text-on-primary-container font-bold text-h2 shadow-lg">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div>
                <h2 class="font-h1 text-h1 text-on-surface">Profile Settings</h2>
                <p class="text-on-surface-variant mt-xs">Manage your account information and security.</p>
            </div>
        </div>

        {{-- Profile Information Card --}}
        <div class="glass-panel rounded-2xl overflow-hidden">
            <div class="px-xl py-lg border-b border-outline-variant flex items-center gap-sm">
                <div class="w-7 h-7 rounded-lg bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-[16px]" style="font-variation-settings: 'FILL' 1;">person</span>
                </div>
                <div>
                    <h3 class="font-h3 text-h3 text-on-surface">Profile Information</h3>
                    <p class="text-on-surface-variant text-body-sm">Update your name and email address.</p>
                </div>
            </div>
            <div class="p-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password Card --}}
        <div class="glass-panel rounded-2xl overflow-hidden">
            <div class="px-xl py-lg border-b border-outline-variant flex items-center gap-sm">
                <div class="w-7 h-7 rounded-lg bg-secondary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings: 'FILL' 1;">lock</span>
                </div>
                <div>
                    <h3 class="font-h3 text-h3 text-on-surface">Update Password</h3>
                    <p class="text-on-surface-variant text-body-sm">Ensure your account stays secure.</p>
                </div>
            </div>
            <div class="p-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Danger Zone Card --}}
        <div class="glass-panel rounded-2xl overflow-hidden border-error/20">
            <div class="px-xl py-lg border-b border-error/20 flex items-center gap-sm bg-error/5">
                <div class="w-7 h-7 rounded-lg bg-error/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-error text-[16px]" style="font-variation-settings: 'FILL' 1;">warning</span>
                </div>
                <div>
                    <h3 class="font-h3 text-h3 text-error">Danger Zone</h3>
                    <p class="text-on-surface-variant text-body-sm">Irreversible and destructive actions.</p>
                </div>
            </div>
            <div class="p-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>

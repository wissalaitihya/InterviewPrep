<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-lg">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="space-y-sm">
            <label class="label-base" for="update_password_current_password">Current Password</label>
            <input id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                placeholder="••••••••"
                class="input-base" />
            @error('current_password', 'updatePassword')
                <p class="text-error text-body-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[14px]">error</span>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- New Password --}}
        <div class="space-y-sm">
            <label class="label-base" for="update_password_password">New Password</label>
            <input id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                placeholder="••••••••"
                class="input-base" />
            @error('password', 'updatePassword')
                <p class="text-error text-body-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[14px]">error</span>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="space-y-sm">
            <label class="label-base" for="update_password_password_confirmation">Confirm New Password</label>
            <input id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                placeholder="••••••••"
                class="input-base" />
            @error('password_confirmation', 'updatePassword')
                <p class="text-error text-body-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[14px]">error</span>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
            <button type="submit" class="btn-primary flex items-center gap-sm">
                <span class="material-symbols-outlined text-[18px]">lock_reset</span>
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-primary text-body-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    Password updated successfully.
                </p>
            @endif
        </div>
    </form>
</section>

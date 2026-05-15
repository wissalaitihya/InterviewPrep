<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-background relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-secondary/10 rounded-full blur-[120px] -z-10"></div>

        <div class="w-full max-w-md space-y-xl">
            {{-- Branding --}}
            <div class="flex flex-col items-center gap-md text-center">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-container to-secondary-container flex items-center justify-center text-on-primary-container font-bold text-2xl shadow-xl">
                    IP
                </div>
                <div>
                    <h2 class="font-h2 text-h2 text-on-surface">Reset Password</h2>
                    <p class="text-on-surface-variant mt-xs">Choose a secure new password for your account.</p>
                </div>
            </div>

            <div class="glass-panel rounded-3xl p-xl shadow-2xl border border-outline-variant/30">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-lg">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="space-y-sm">
                        <label class="label-base" for="email">Email Address</label>
                        <input id="email" class="input-base" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-sm">
                        <label class="label-base" for="password">New Password</label>
                        <input id="password" class="input-base" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-sm">
                        <label class="label-base" for="password_confirmation">Confirm New Password</label>
                        <input id="password_confirmation" class="input-base" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <button type="submit" class="btn-primary w-full h-12 flex items-center justify-center gap-sm">
                        <span class="material-symbols-outlined text-[18px]">lock_reset</span>
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

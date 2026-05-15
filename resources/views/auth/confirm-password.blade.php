<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-background relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-error/10 rounded-full blur-[120px] -z-10"></div>

        <div class="w-full max-w-md space-y-xl text-center">
            <div class="flex justify-center">
                <div class="w-16 h-16 rounded-2xl bg-error/10 flex items-center justify-center text-error shadow-xl">
                    <span class="material-symbols-outlined text-[32px]" style="font-variation-settings: 'FILL' 1;">lock</span>
                </div>
            </div>

            <div>
                <h2 class="font-h2 text-h2 text-on-surface">Confirm Password</h2>
                <p class="text-on-surface-variant mt-xs">This is a secure area of the application. Please confirm your password before continuing.</p>
            </div>

            <div class="glass-panel rounded-3xl p-xl border border-outline-variant/30 text-left">
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-lg">
                    @csrf

                    <!-- Password -->
                    <div class="space-y-sm">
                        <label class="label-base" for="password">Password</label>
                        <input id="password" class="input-base" type="password" name="password" required autocomplete="current-password" autofocus placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <button type="submit" class="btn-primary w-full h-12 flex items-center justify-center gap-sm">
                        <span class="material-symbols-outlined text-[18px]">verified_user</span>
                        Confirm Access
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-background relative overflow-hidden">
        {{-- Background Glow --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/10 rounded-full blur-[120px] -z-10"></div>

        <div class="w-full max-w-md space-y-xl">
            {{-- Branding --}}
            <div class="flex flex-col items-center gap-md text-center">
                <a href="/" class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-container to-secondary-container flex items-center justify-center text-on-primary-container font-bold text-2xl shadow-xl">
                    IP
                </a>
                <div>
                    <h2 class="font-h2 text-h2 text-on-surface">Forgot Password?</h2>
                    <p class="text-on-surface-variant mt-xs">No problem. Just let us know your email address and we will email you a password reset link.</p>
                </div>
            </div>

            <div class="glass-panel rounded-3xl p-xl shadow-2xl border border-outline-variant/30">
                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-lg">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-sm">
                        <label class="label-base" for="email">Email Address</label>
                        <input id="email" class="input-base" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <button type="submit" class="btn-primary w-full h-12 flex items-center justify-center gap-sm">
                        <span class="material-symbols-outlined text-[18px]">send</span>
                        Email Reset Link
                    </button>
                </form>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-body-sm text-primary font-semibold hover:underline flex items-center justify-center gap-xs">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    Back to Sign In
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

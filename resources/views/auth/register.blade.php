<x-guest-layout>
    <main class="w-full h-screen flex flex-col md:flex-row overflow-hidden bg-background">
        {{-- Left Side: Hero --}}
        <div class="hidden md:flex md:w-1/2 relative bg-surface-container-lowest flex-col justify-between p-2xl border-r border-outline-variant/30 overflow-hidden group">
            <div class="absolute inset-0 -z-10 opacity-20 pointer-events-none">
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary rounded-full mix-blend-screen filter blur-[128px] opacity-30"></div>
                <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-tertiary rounded-full mix-blend-screen filter blur-[128px] opacity-30"></div>
            </div>

            <a href="/" class="relative z-10 flex items-center gap-sm">
                <div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-xl shadow-lg">IP</div>
                <span class="font-display text-xl font-bold tracking-tight text-on-surface">InterviewPrep</span>
            </a>

            <div class="relative z-10 flex-1 flex items-center justify-center py-xl">
                <div class="relative w-full max-w-sm aspect-square rounded-[3rem] glass-panel overflow-hidden shadow-2xl transition-transform duration-700 ease-out group-hover:scale-105">
                    <div class="w-full h-full bg-gradient-to-br from-primary/20 to-tertiary/20 flex items-center justify-center relative">
                         <span class="material-symbols-outlined text-[120px] text-primary/30" style="font-variation-settings: 'FILL' 1;">person_add</span>
                         <div class="absolute top-10 right-10 left-10 p-lg glass-panel rounded-2xl border-outline-variant/30">
                            <div class="h-2 w-32 bg-primary/40 rounded mb-2"></div>
                            <div class="h-2 w-20 bg-on-surface-variant/20 rounded"></div>
                         </div>
                    </div>
                </div>
            </div>

            <div class="relative z-10">
                <h1 class="font-display text-3xl font-bold text-on-surface mb-md">Join the elite developers.</h1>
                <p class="text-on-surface-variant max-w-md">Start your preparation journey today and get ready for your dream career.</p>
            </div>
        </div>

        {{-- Right Side: Form --}}
        <div class="w-full md:w-1/2 flex items-center justify-center p-lg sm:p-2xl relative overflow-y-auto">
            <div class="absolute top-lg left-lg md:hidden flex items-center gap-sm z-10">
                <div class="w-8 h-8 rounded-lg bg-primary-container flex items-center justify-center text-on-primary-container font-bold">IP</div>
                <span class="font-display font-bold text-on-surface">InterviewPrep</span>
            </div>

            <div class="w-full max-w-sm space-y-xl z-10 py-12">
                <div>
                    <h2 class="font-h2 text-h2 text-on-surface">Create Account</h2>
                    <p class="text-on-surface-variant mt-xs">Fill in the details to start your 7-day trial.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-lg">
                    @csrf

                    <div class="space-y-sm">
                        <label class="label-base" for="name">Full Name</label>
                        <input id="name" class="input-base" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" />
                        <x-input-error :messages="$errors->get('name')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <div class="space-y-sm">
                        <label class="label-base" for="email">Email Address</label>
                        <input id="email" class="input-base" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <div class="space-y-sm">
                        <label class="label-base" for="password">Password</label>
                        <input id="password" class="input-base" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <div class="space-y-sm">
                        <label class="label-base" for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" class="input-base" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-xs text-error text-body-sm" />
                    </div>

                    <button type="submit" class="btn-primary w-full h-12 flex items-center justify-center gap-sm">
                        <span class="material-symbols-outlined text-[18px]">rocket_launch</span>
                        Create Account
                    </button>
                </form>

                <div class="text-center pt-lg border-t border-outline-variant/30">
                    <p class="text-body-sm text-on-surface-variant">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Sign in instead</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>
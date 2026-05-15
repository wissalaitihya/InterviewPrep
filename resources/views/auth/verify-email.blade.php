<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-background relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-tertiary/10 rounded-full blur-[120px] -z-10"></div>

        <div class="w-full max-w-md space-y-xl text-center">
            {{-- Illustration --}}
            <div class="flex justify-center">
                <div class="w-20 h-20 rounded-3xl bg-tertiary/10 flex items-center justify-center text-tertiary shadow-xl">
                    <span class="material-symbols-outlined text-[48px]" style="font-variation-settings: 'FILL' 1;">mark_email_read</span>
                </div>
            </div>

            <div>
                <h2 class="font-h2 text-h2 text-on-surface">Verify Email</h2>
                <p class="text-on-surface-variant mt-xs px-4">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
            </div>

            <div class="glass-panel rounded-3xl p-xl border border-outline-variant/30 text-left">
                @if (session('status') === 'verification-link-sent')
                    <div class="mb-6 p-md rounded-xl bg-primary/10 border border-primary/20 text-primary text-body-sm flex gap-sm">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                @endif

                <div class="flex flex-col gap-md">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn-primary w-full h-12 flex items-center justify-center gap-sm">
                            <span class="material-symbols-outlined text-[18px]">forward_to_inbox</span>
                            Resend Verification Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-ghost w-full h-12">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

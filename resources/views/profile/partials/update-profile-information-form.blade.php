<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-lg">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div class="space-y-sm">
            <label class="label-base" for="name">Full Name</label>
            <input id="name" name="name" type="text"
                value="{{ old('name', $user->name) }}"
                required autofocus autocomplete="name"
                class="input-base"
                placeholder="Your full name" />
            @error('name')
                <p class="text-error text-body-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[14px]">error</span>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="space-y-sm">
            <label class="label-base" for="email">Email Address</label>
            <input id="email" name="email" type="email"
                value="{{ old('email', $user->email) }}"
                required autocomplete="username"
                class="input-base"
                placeholder="you@example.com" />
            @error('email')
                <p class="text-error text-body-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[14px]">error</span>
                    {{ $message }}
                </p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="flex items-center gap-sm p-sm bg-tertiary/10 rounded-lg border border-tertiary/20">
                    <span class="material-symbols-outlined text-tertiary text-[16px]">mail</span>
                    <p class="text-on-surface text-body-sm flex-1">
                        Your email is unverified.
                        <button form="send-verification"
                            class="text-primary hover:underline font-medium ml-xs">
                            Resend verification email
                        </button>
                    </p>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="text-primary text-body-sm flex items-center gap-xs">
                        <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        A new verification link has been sent to your email.
                    </p>
                @endif
            @endif
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
            <button type="submit" class="btn-primary flex items-center gap-sm">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-primary text-body-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    Profile updated successfully.
                </p>
            @endif
        </div>
    </form>
</section>

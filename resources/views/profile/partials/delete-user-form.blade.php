<section class="space-y-6">
    <div class="flex items-center gap-md">
        <div class="flex-1">
            <h2 class="text-lg font-semibold text-on-surface">
                {{ __('Delete Account') }}
            </h2>

            <p class="mt-1 text-sm text-on-surface-variant">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone.') }}
            </p>
        </div>
        <button
            type="button"
            class="btn-danger flex items-center gap-sm px-lg"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            <span class="material-symbols-outlined text-[18px]">delete_forever</span>
            {{ __('Delete Account') }}
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-xl bg-surface-container rounded-2xl border border-outline-variant">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-on-surface mb-md">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="text-sm text-on-surface-variant mb-lg">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="space-y-sm">
                <label class="label-base" for="password">{{ __('Password') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="input-base"
                    placeholder="{{ __('Confirm your password') }}"
                />

                @if($errors->userDeletion->has('password'))
                    <p class="text-error text-body-sm flex items-center gap-xs mt-xs">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        {{ $errors->userDeletion->first('password') }}
                    </p>
                @endif
            </div>

            <div class="mt-xl flex justify-end gap-md pt-lg border-t border-outline-variant">
                <button type="button" class="btn-ghost" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn-danger flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[18px]">delete_forever</span>
                    {{ __('Permanently Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

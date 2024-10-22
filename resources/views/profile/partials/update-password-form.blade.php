<section>
    <header>
        <p class="section-content">
            {{ __('profile.update_password_description') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 sectionWrapper">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('profile.current_password')" class="section-content" />
            <br>
            <x-text-input id="current_password" name="current_password" type="password" class="authTextField w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('profile.new_password')" class="section-content" />
            <br>
            <x-text-input id="password" name="password" type="password" class="authTextField w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('profile.confirm_password')" class="section-content" />
            <br>
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="authTextField w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="approveButton">{{ __('profile.save') }}</button>
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('profile.saved') }}</p>
            @endif
        </div>
    </form>
</section>

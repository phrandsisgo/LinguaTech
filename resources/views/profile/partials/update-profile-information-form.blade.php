<section>
    <br><br>
    <header>
        <p class="section-content">
            {{ __('profile.update_profile_information_description') }}
        </p>
    </header>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 sectionWrapper">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('profile.name')" class="section-content"/>
            <br>
            <x-text-input id="name" name="name" type="text" class="authTextField w-full" :value="old('name', $user->name)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('profile.email')" class="section-content"/>
            <br>
            <x-text-input id="email" name="email" type="email" class="authTextField w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('profile.email_unverified') }}

                        <button form="send-verification" class="approveButton">
                            {{ __('profile.resend_verification_email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('profile.verification_link_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="approveButton">{{ __('profile.save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="approveButton"
                >{{ __('profile.saved') }}</p>
            @endif
        </div>
    </form>
</section>
<br><br>

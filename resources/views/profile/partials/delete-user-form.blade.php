<section class="space-y-6">
    <br><br>
    <header>
        <h2 class="sectiontitle">
            {{ __('Account löschen') }}
        </h2>

        <p class="section-content">
            {{ __('Sobald ihr Account gelöscht ist, sind alle Ihre Daten permanent gelöscht.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="standartButton"
    >{{ __('Account löschen') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Sind Sie sich sicher, ob sie Ihren Account löschen möchten?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Sobald ihr Account gelöscht ist, sind alle Ihre Daten permanent gelöscht.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Passwort') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Abbrechen') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Account löschen') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

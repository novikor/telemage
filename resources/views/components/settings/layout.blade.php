<section>
    <flux:sidebar>
        <div class="me-10 w-full pb-4 md:w-[220px]">
            <flux:navlist>
                <flux:navlist.item :href="route('filament.dashboard.auth.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
                <flux:navlist.item :href="route('user-password.edit')"
                                   wire:navigate>{{ __('Password') }}</flux:navlist.item>
                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <flux:navlist.item :href="route('two-factor.show')"
                                       wire:navigate>{{ __('Two-Factor Auth') }}</flux:navlist.item>
                @endif
                <flux:navlist.item :href="route('appearance.edit')"
                                   wire:navigate>{{ __('Appearance') }}</flux:navlist.item>
            </flux:navlist>
        </div>
    </flux:sidebar>

    <flux:separator class="md:hidden"/>

    <flux:main>
        <div class="flex-1 self-stretch max-md:pt-6">
            <flux:heading>{{ $heading ?? '' }}</flux:heading>
            <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

            <div class="mt-5 w-full max-w-lg">
                {{ $slot }}
            </div>
        </div>
    </flux:main>
</section>

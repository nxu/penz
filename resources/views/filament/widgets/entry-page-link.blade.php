<x-filament-widgets::widget>
    <x-filament::section>
        <h2 class="fi-account-widget-heading">
            Költések rögzítése
        </h2>

        <div class="flex gap-4">
            <img src="{{ (new \chillerlan\QRCode\QRCode())->render(\Illuminate\Support\Facades\URL::signedRoute('entry.form', ['user' => auth()->user() ])) }}"
                 alt="Link QR kód"
                 class="max-w-48"
            >

            <x-filament::link
                color="gray"
                href="{{ \Illuminate\Support\Facades\URL::signedRoute('entry.form', ['user' => auth()->user() ]) }}"
                :icon="\Filament\Support\Icons\Heroicon::Link"
                rel="noopener noreferrer"
                target="_blank"
            >
                Megnyitás
            </x-filament::link>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

<div>
    <x-header title="SMS Versenden" separator />
    <x-card title="Your stats" shadow separator progress-indicator>
        @if($data)
            <pre>{{ print_r($data, true) }}</pre>
        @else
            <p>Keine Daten verfügbar.</p>
        @endif
        <x-button wire:click="fetchData">Daten abrufen</x-button>
    </x-card>
</div>

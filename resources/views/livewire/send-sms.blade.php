<div>
    <x-card title="SMS Versenden" shadow separator progress-indicator>
        <x-form wire:submit="sendSms">
            <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />
            <x-input label="Absender" wire:model="from" ></x-input>
            <x-input label="Empfänger" hint="Im Format 0791234567 oder 0041791234567" wire:model.lazy="to" />
            <x-textarea label="Nachricht" hint="Maximal 160 Zeichen" wire:model="text" rows="2"  />
            <x-slot:actions>
                <x-button label="Abbrechen" />
                <x-button label="Senden" class="btn-primary" type="submit" spinner="senden" />
            </x-slot:actions>
        </x-form>
    </x-card>
    <x-toast />
</div>

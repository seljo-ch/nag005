<div>
    <h2 class="text-xl font-semibold">Notiz für Anruf</h2>

    <div class="mb-4">
        <p><strong>Anruf ID:</strong> {{ $callId }}</p>
        <p><strong>Telefonnummer:</strong> <a href="tel:{{ $callerNumber }}" class="text-blue-500">{{ $callerNumber }}</a></p>
    </div>

    <x-input label="Notiz" wire:model="note" placeholder="Gib eine Notiz ein..." />

    <div class="mt-4 flex justify-end space-x-2">
        <x-button label="Speichern" wire:click="saveNote" />
        <x-button label="Abbrechen" wire:click="$emit('closeModal')" />
    </div>
</div>

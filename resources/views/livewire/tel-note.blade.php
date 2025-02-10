<div>
    <x-form wire:submit="save">
        <x-input label="Absender" icon="o-user" wire:model="senderEmail" />
        <x-input label="Empfänger" icon="o-user" clearable />
        <x-input label="Telefonnummer" placeholder="Telefonnummer" icon="o-phone" wire:model="callerNumber" clearable/>
        <x-input label="Anrufername" placeholder="Anrufername" icon="o-user" wire:model="callerName" clearable/>
        <x-datetime label="Date + Time" wire:model="callerDate" icon="o-calendar" type="datetime-local" />
        <x-select label="Vordefinierte Nachrichten" icon="o-user"  wire:model="selectedUser" tooltip="Folgt" />
        <x-input label="Betreff" placeholder="" icon="o-user" clearable />
        <x-editor wire:model="text" label="Nachricht" :config="$config"/>
        <x-slot:actions>
            <x-button label="Speichern & Senden" wire:click="saveNote" spinner/>
            <x-button label="Abbrechen" wire:click="closeModal" spinner/>
        </x-slot:actions>
    </x-form>
</div>

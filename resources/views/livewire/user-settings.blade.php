<div>
    <h2>Einstellungen</h2>
    <form wire:submit.prevent="save">
        <label><input type="checkbox" wire:model="show_forwarding"> Weiterleitungsfelder anzeigen</label><br>
        <label><input type="checkbox" wire:model="edit_forwarding"> Weiterleitungsfelder bearbeiten</label><br>
        <label><input type="checkbox" wire:model="disable_forwarding"> Weiterleitungsfelder deaktivieren</label><br>
        <label><input type="checkbox" wire:model="show_shortnotes"> ShortNotes anzeigen</label><br>
        <label><input type="checkbox" wire:model="edit_own_shortnotes_only"> Nur eigene ShortNotes bearbeiten</label><br>
        <button type="submit">Speichern</button>
    </form>
</div>

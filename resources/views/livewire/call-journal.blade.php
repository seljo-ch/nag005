<div>
    <!-- HEADER -->
    <x-header title="Telefon Journal">
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Suche..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass"/>
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filter" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$calls" :sort-by="$sortBy" with-pagination class="table-xs" striped >
            @scope('cell_callerNumber',$call)
                <x-button label="{{ $call['callerNumber'] }}" link="tel:{{ $call['callerNumber'] }}" external icon="o-phone" tooltip="Anrufen" class="btn-ghost btn btn-xs" />
            @endscope
            @scope('cell_shortNote', $call)
            <div class="flex space-x-2">
                <x-input wire:model.defer="shortNotes.{{ $call['id'] }}" class="input-sm"  />
                <x-button icon="o-check" class="btn-primary btn-sm" wire:click="saveShortNote({{ $call['id'] }})" tooltip="Short Note speichern" />
            </div>
            @endscope
            @scope('cell_note', $call)
                @if (!empty($call['note']))
                    <x-icon name="s-envelope" class="w-5 h-5 text-green-500 text-2xl" />
                @endif
            @endscope

            @scope('cell_internalCall', $call)
                @if (!empty($call['internalCall']))
                    <x-icon name="m-check-circle" class="w-5 h-5 text-green-500 text-2xl" />
                @endif
            @endscope

            @scope('actions', $call)
            <div class="flex space-x-2">
                <x-button icon="c-plus-circle"
                          wire:click="openTelNote({{ $call['id'] }})"
                          tooltip-left="Neues E-Mail" />
            </div>
            @endscope


        </x-table>
    </x-card>
    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filter" right separator with-close-button class="lg:w-1/3">

        <x-input label="Suche nach Name oder Telefonnummer" placeholder="Suchen..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />
        <br />
        <x-datetime label="Datum" wire:model.live.debounce="date" icon="o-calendar" clearable />
        <br />
        <x-toggle label="Interne Anrufe" wire:model.live="hideInternalCalls" right hint="Blendet interne Anrufe aus" checked/>
        <hr /><br />
        <x-toggle label="Notiz" wire:model.live="hideNotedCalls" right hint="Blendet Anrufe mit einer Notiz aus" />
        <hr />
        <br />

        <x-input label="Kürzel/Benutzer" placeholder="Suchen..." wire:model.live.debounce="userFilter" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />
        <br />

        <x-slot:actions>
            <x-button label="Löschen" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Suchen" icon="o-check" class="btn-primary" wire:click="load_callJournal" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>

    <!-- Modal new Tel Note -->

    <x-modal wire:model.defer="TelNote" class="backdrop-blur" title="Notiz für: {{ $selectedCallId ? App\Models\CallJournal::find($selectedCallId)?->CallerNumber : '' }}"
            subtitle="Erstelle eine Gesprächsnotiz für diesen Anruf und sende diese per E-Mail." box-class="w-11/12 max-w-5xl">

        <livewire:tel-note-create :call-id="$selectedCallId" wire:key="'tel-note-' . $selectedCallId" />
    </x-modal>






</div>

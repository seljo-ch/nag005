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
        <x-table :headers="$headers" :rows="$calls" :sort-by="$sortBy" with-pagination>
            @scope('cell_CallerNumber',$call)
                <x-button label="{{ $call['CallerNumber'] }}" link="tel:{{ $call['CallerNumber'] }}" external icon="o-phone" tooltip="Anrufen" class="btn-ghost btn btn-xs" />
            @endscope

            @scope('cell_Note', $call)
                @if (!empty($call['Note']))
                    <x-icon name="s-envelope" class="w-5 h-5 text-green-500 text-2xl" />
                @endif
            @endscope

            @scope('actions', $call)
            <div class="flex space-x-2">
                <x-button icon="c-plus-circle"
                          wire:click="openTelNote({{ $call['id'] }})"
                          tooltip-left="Neue Notiz" />
            </div>
            @endscope


        </x-table>
    </x-card>
    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filter" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>

    <!-- Modal new Tel Note -->

    <x-modal wire:model.defer="TelNote" class="backdrop-blur" title="Notiz für: {{ $selectedCallId ? App\Models\CallLog::find($selectedCallId)?->CallerNumber : '' }}"
            subtitle="Erstelle eine Gesprächsnotiz für diesen Anruf und sende diese per E-Mail." box-class="w-11/12 max-w-5xl">

        <livewire:tel-note-create :call-id="$selectedCallId" wire:key="'tel-note-' . $selectedCallId" />
    </x-modal>






</div>

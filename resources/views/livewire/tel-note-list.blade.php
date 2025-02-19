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
        <x-table :headers="$headers" :rows="$notes" :sort-by="$sortBy" with-pagination />
    </x-card>
    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filter" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
</div>

<div>
    <!-- HEADER -->
    <x-header title="Users" subtitle="Check this on mobile">
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
                <x-popover position="top-start" offset="5">
                    <x-slot:trigger>
                        <a href="tel:{{ $call['CallerNumber'] }}" class="text-blue-500 hover:underline">{{ $call['CallerNumber'] }}</a>
                    </x-slot:trigger>
                    <x-slot:content>
                        {{ $call['CallerNumber'] }} Anrufen
                    </x-slot:content>
                </x-popover>

            @endscope
            @scope('cell_Note', $call)
                @if (!empty($call['Note']))
                    <x-icon name="s-envelope" class="w-5 h-5 text-green-500 text-2xl" />
                @endif
            @endscope
            @scope('actions', $call)
                <div class="flex space-x-2">
                    <x-button icon="c-pencil-square" wire:click="editUser({{ $call['id'] }})" spinner class="btn-ghost btn-sm" />
                    <x-button icon="o-trash" wire:click="delete({{ $call['id'] }})" spinner class="btn-ghost btn-sm text-red-500" />
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
</div>
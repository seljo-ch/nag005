<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\TelNote as TelNoteModel; // 🔥 Alias setzen
use Mary\Traits\Toast;
use Livewire\WithPagination;

class TelNoteList extends Component
{
    use WithPagination;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public bool $drawer = false;
    public string $search = '';

    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'senderEmail', 'label' => 'Absender', 'class' => 'w-64'],
            ['key' => 'recipientEmail', 'label' => 'Empfänger', 'class' => 'w-64'],
            ['key' => 'callerNumber', 'label' => 'Anrufer Nummer', 'class' => 'w-64'],
            ['key' => 'callerName', 'label' => 'Anrufer Name', 'class' => 'w-64'],
            ['key' => 'callerDate', 'label' => 'Datum & Zeit', 'format' => ['date', 'd.m.Y - H:m']],
            ['key' => 'subject', 'label' => 'Betreff', 'class' => 'w-10', ],
            ['key' => 'message', 'label' => 'Nachricht', 'class' => 'w-10', ],
        ];
    }

    public function load_notes(): LengthAwarePaginator
    {
        return TelNoteModel::query()
            ->when($this->search, function (Builder $q) {
                $q->where('CallerNumber', 'like', "%{$this->search}%")
                    ->orWhere('callerName', 'like', "%{$this->search}%");
            })
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.tel-note-list',[
            'notes' => $this->load_notes(),
            'headers' => $this->headers(),
        ]);
    }
}

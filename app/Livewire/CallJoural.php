<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\CallLog;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class CallJoural extends Component
{
    use Toast;
    use WithPagination;

    public $userEMail = 'olivier.sebel@nyffenegger.ch';
    public $callJournalResults;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public bool $drawer = false;
    public string $search = '';
    public $TelNote = false; // Steuert das Modal
    public $selectedCallId;   // Speichert die Call-ID

    protected $listeners = ['closeTelNote' => 'closeTelNote'];

    public function closeTelNote()
    {
        $this->TelNote = false;
        logger()->info('Close Modal aufgerufen');

    }


    public function openTelNote($callId)
    {
        $this->selectedCallId = $callId;
        $this->TelNote = true;

        logger()->info('openTelNote aufgerufen', ['selectedCallId' => $this->selectedCallId]);

        // Livewire anweisen, dass TelNoteCreate sich aktualisiert
        $this->dispatch('refreshTelNote', $this->selectedCallId);
    }


    public function headers(): array
    {
        return [
            //  ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'CallerNumber', 'label' => 'Telefonnummer', 'class' => 'w-64'],
            ['key' => 'CallerDisplayName', 'label' => 'Name', 'class' => 'w-64'],
            // ['key' => 'Email', 'label' => 'E-mail', 'sortable' => false],
            ['key' => 'Timestamp', 'label' => 'Datum & Zeit', 'format' => ['date', 'd.m.Y - H:m']],
            ['key' => 'Note', 'label' => 'Notiz', 'class' => 'w-10', ],
        ];
    }

    public function load_callJournal(): LengthAwarePaginator
    {
        return CallLog::query()
            ->when($this->search, function (Builder $q) {
                $q->where('CallerNumber', 'like', "%{$this->search}%")
                    ->orWhere('CallerDisplayName', 'like', "%{$this->search}%");
            })
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10);
    }

    public function mount()
    {
        // $this->userEMail = auth()->user()->email;
    }



    public function render()
    {
        return view('livewire.call-journal',[
            'calls' => $this->load_callJournal(),
            'headers' => $this->headers(),
        ]);
    }
}

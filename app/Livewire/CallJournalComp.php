<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\CallJournal;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class CallJournalComp extends Component
{
    use Toast;
    use WithPagination;

    public $userEMail = 'olivier.sebel@nyffenegger.ch';
    public $callJournalResults;
    public array $sortBy = ['column' => 'id', 'direction' => 'desc'];
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
            ['key' => 'callerNumber', 'label' => 'Telefonnummer', 'class' => 'w-64'],
            ['key' => 'callerDisplayName', 'label' => 'Name', 'class' => 'w-64'],
            // ['key' => 'Email', 'label' => 'E-mail', 'sortable' => false],
            ['key' => 'timestamp', 'label' => 'Datum & Zeit', 'format' => ['date', 'd.m.Y - H:m']],
            ['key' => 'note', 'label' => 'Notiz', 'class' => 'w-10', ],
        ];
    }

    public function load_callJournal(): LengthAwarePaginator
    {
        return CallJournal::query()
            ->when($this->search, function (Builder $q) {
                $q->where('callerNumber', 'like', "%{$this->search}%")
                    ->orWhere('callerDisplayName', 'like', "%{$this->search}%");
            })
            ->orderBy($this->sortBy['column'] ?? 'id', $this->sortBy['direction'] ?? 'desc')
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

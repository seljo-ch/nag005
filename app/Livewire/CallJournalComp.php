<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\CallJournal;
use App\Models\ShortNote;
use App\Models\User;
use App\Models\UserSetting;
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

    //Filter
    public $date = ''; // Datumsbereich-Filter
    public bool $hideInternalCalls = true; // Interne Anrufe ausblenden
    public bool $hideNotedCalls = false; // Anrufe mit Notiz ausblenden
    public string $userFilter = ''; // Kürzel/Benutzer Filter


    // Short Notes
    public array $shortNotes = [];

    // UserSettings
    public $forwarded_to;
    public $forwarded_via;
    public $showForwarding;
    public $editForwarding;
    public $disableForwarding;
    public $showShortnotes;
    public $editOwnShortnotesOnly;

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
            ['key' => 'callerNumber', 'label' => 'Telefonnummer', 'class' => 'w-15'],
            ['key' => 'callerDisplayName', 'label' => 'Name', 'class' => 'w-25'],
            ['key' => 'timestamp', 'label' => 'Datum & Zeit', 'format' => ['date', 'd.m.Y - H:i:s'], 'class' => 'w-10' ],
            //   ['key' => 'adUserEmail', 'label' => 'Benutzer', 'class' =>'w-13'],
            ['key' => 'adUser', 'label' => 'Benutzer'],
            ['key' => 'shortNote', 'label' => 'Notiz', 'class' => 'w-10'],
            ['key' => 'forwarded_to', 'label' => 'forwarded_to', 'class' => 'w-10'],
            ['key' => 'forwarded_via', 'label' => 'forwarded_via', 'class' => 'w-10'],
            ['key' => 'note', 'label' => 'E-Mail' , 'class' => 'w-1'],
            ['key' => 'internalCall', 'label' => 'Intern' , 'class' => 'w-1'],
        ];
    }

    public function load_callJournal(): LengthAwarePaginator
    {
        logger()->info('DateRange Wert:', ['dateRange' => $this->date]);

        return CallJournal::query()
            ->when($this->search, function (Builder $q) {
                $q->where('callerNumber', 'like', "%{$this->search}%")
                    ->orWhere('callerDisplayName', 'like', "%{$this->search}%");
            })
            ->when($this->date, function (Builder $q) {
                // Prüfen, ob ein Datumswert vorhanden ist

                    $q->where('timestamp', 'like', "%{$this->date}%");

            })
            ->when($this->hideInternalCalls, function (Builder $q) {
                $q->where('internalCall', '!=', 1); // Alle internen Anrufe ausblenden
            })
            ->when($this->hideNotedCalls, function (Builder $q) {
                $q->where('note', '!=', 1);
            })
            ->when($this->userFilter, function (Builder $q) {
                $q->where('aduser', 'like', "%{$this->userFilter}%");
            })

            ->orderBy($this->sortBy['column'] ?? 'id', $this->sortBy['direction'] ?? 'desc')
            ->paginate(25)
            ->through(function ($call) {
                // Präfix aus AD-User entfernen
                $call->adUser = Str::afterLast($call->adUser, '\\');
                return $call;
            });
    }

    public function clear()
    {
        // Setzt alle Filter zurück
        $this->search = '';
        $this->date = '';
        $this->hideInternalCalls = true;
        $this->hideNotedCalls = false;
        $this->userFilter = '';
    }

    public function mount()
{
    $settings = auth()->user()->settings;

    $this->show_forwarding = $settings->show_forwarding ?? true;
    $this->edit_forwarding = $settings->edit_forwarding ?? true;
    $this->disable_forwarding = $settings->disable_forwarding ?? false;
    $this->show_shortnotes = $settings->show_shortnotes ?? true;
    $this->edit_own_shortnotes_only = $settings->edit_own_shortnotes_only ?? true;
}

    public function loadShortNotes()
    {
        $this->shortNotes = ShortNote::pluck('note', 'call_journal_id')->toArray();
    }
    public function saveShortNote($callJournalId)
    {
        if (!isset($this->shortNotes[$callJournalId])) {
            return;
        }

        $noteText = trim($this->shortNotes[$callJournalId]);

        if (empty($noteText)) {
            ShortNote::where('call_journal_id', $callJournalId)->delete();
        } else {
            ShortNote::updateOrCreate(
                ['call_journal_id' => $callJournalId],
                ['note' => $noteText]
            );
        }
        $this->success('Notiz erfolgreich gespeichert!',  timeout: 5000);
    }

    public function save()
    {
        $user = auth()->user();
        $call = new CallJournal();
        // ... bestehende Felder
        if ($user->getSetting('show_forwarding') && !$user->getSetting('disable_forwarding')) {
            $call->forwarded_to = $this->forwarded_to;
            $call->forwarded_via = $this->forwarded_via;
        }
        $call->save();
        // ...
    }
    public function render()
    {
        return view('livewire.call-journal',[
            'calls' => $this->load_callJournal(),
            'headers' => $this->headers(),
        ]);
    }
}

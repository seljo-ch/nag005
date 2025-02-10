<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\CallLog;

class TelNote extends Component
{
    public $callId;
    public $callerNumber;
    public $callerName;
    public $callerDate;
    public $senderEmail;
    public $text;
    public $selectedUser;
    protected $listeners = ['refreshTelNote' => 'reloadData'];
    public function mount($callId = null)
    {
        logger()->info("TelNote mount() mit Call-ID: " . json_encode($callId));

        if ($callId) {
            $this->callId = $callId;
            $this->loadCallData($callId);
        } else {
            logger()->error('TelNote mount() ohne callId aufgerufen!');
        }

        // Angemeldete Benutzer-E-Mail setzen
        $this->senderEmail = Auth::check() ? Auth::user()->email : 'Nicht angemeldet';
    }
    public function reloadData($callId = null)
    {
        if ($callId) {
            $this->callId = $callId;
        }

        if (!$this->callId) {
            logger()->error('reloadData() ohne callId!');
            return;
        }

        logger()->info("TelNote reloadData() mit Call-ID: {$this->callId}");
        $this->loadCallData($this->callId);
    }
    public function loadCallData($callId)
    {
        logger()->info("Lade Daten für Call-ID: {$callId}");

        $this->callId = $callId;
        $call = CallLog::find($callId);

        if ($call) {
            $this->callerNumber = $call->CallerNumber;
            $this->callerName = $call->CallerDisplayName;
            $this->callerDate = $call->Timestamp; // Setzt Datum & Uhrzeit
            logger()->info("Call-Daten geladen: " . json_encode($call));
        } else {
            logger()->error("Kein Eintrag für Call-ID gefunden: {$callId}");
        }
    }

    public function saveNote()
    {
        // Hier kannst du die Daten speichern oder per Mail versenden
        logger()->info("Speichere Notiz für Call-ID: {$this->callId}");
    }

    public function closeModal()
    {
        $this->dispatch('closeTelNote');
    }
    public function configTiny(): array
    {
        return [
            'plugins' => 'autoresize',
            'statusbar' => false,
            'toolbar'=> 'undo redo | styles | bold italic underline| link image | fontsize',
            'quickbars_selection_toolbar' => 'bold italic underline link',
        ];
    }
    public function render()
    {
        return view('livewire.tel-note',[
        'config' => $this->configTiny()]);
    }
}

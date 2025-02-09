<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CallLog;

class TelNote extends Component
{
    public $callId;
    public $callerNumber;
    public $note;

    public function mount($callId = null)
    {
        if ($callId) {
            $this->loadCallData($callId);
        } else {
            logger()->error('TelNote mount() aufgerufen ohne callId!');
        }
    }

    public function loadCallData($callId)
    {
        $this->callId = $callId;

        $call = CallLog::find($callId);

        if ($call) {
            $this->callerNumber = $call->CallerNumber;
            $this->note = $call->note ?? '';
        } else {
            logger()->error("Kein Eintrag für Call-ID gefunden: {$callId}");
        }
    }

    public function saveNote()
    {
        if ($this->callId) {
            CallLog::where('id', $this->callId)->update(['note' => $this->note]);
        }

        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.tel-note');
    }
}


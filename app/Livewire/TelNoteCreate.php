<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\CallLog;
use App\Models\TelNote as TelNoteModel; // 🔥 Alias setzen
use Mary\Traits\Toast;
use App\Models\Message; // Nachrichten Model einbinden
use App\Models\User; // Nachrichten Model einbinden

class TelNoteCreate extends Component
{

    use Toast;
    public $callId;
    public $callerNumber;
    public $callerName;
    public $callerDate;
    public $senderEmail;
    public $recipientEmail;
    public $subject;

    public $messages = []; // Speichert Nachrichten als options-Array
    public $selectedMessage; // Neue Variable für die Auswahl
    public $text;
    protected $listeners = ['refreshTelNote' => 'reloadData'];

    public function clearForm()
    {
     $this->callId = null;
     $this->callerNumber = null;
     $this->callerName = null;
     $this->callerDate = null;
     $this->senderEmail = null;
     $this->recipientEmail = null;
     $this->subject = null;
     $this->text = null;
    }
    public function mount($callId = null)
    {
        logger()->info("TelNoteCreate mount() mit Call-ID: " . json_encode($callId));

        if ($callId) {
            $this->callId = $callId;
            $this->loadCallData($callId);
        } else {
            logger()->error('TelNoteCreate mount() ohne callId aufgerufen!');
        }

        $this->messages = Message::pluck('title', 'id')->toArray();


        // Angemeldete Benutzer-E-Mail setzen
        $this->senderEmail = Auth::check() ? Auth::user()->email : 'Nicht angemeldet';


    }

    public function getMessages()
    {
        return Message::pluck('title', 'id')->toArray();
    }

    public function updatedSelectedMessage($messageId)
    {
        if ($messageId) {
            $message = Message::find($messageId);
            if ($message) {
                $this->text = $message->content; // Setzt den Text der ausgewählten Nachricht
            }
        }
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

        logger()->info("TelNoteCreate reloadData() mit Call-ID: {$this->callId}");
        $this->loadCallData($this->callId);
    }
    public function loadCallData($callId)
    {
        logger()->info("Lade Daten für Call-ID: {$callId}");

        $this->callId = $callId;
        $call = CallLog::find($callId);
        $this->messages = Message::pluck('title', 'id')->toArray();

        if ($call) {
            $this->senderEmail = Auth::check() ? Auth::user()->email : 'Nicht angemeldet';
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
        logger()->info("Speichere Notiz für Call-ID: {$this->callId}");

        // Speichere die Notiz in der TelNoteCreate-Tabelle
        $telNote = TelNoteModel::create([
            'call_id' => $this->callId, // Verbindung zur CallLog-ID (optional)
            'senderEmail' => $this->senderEmail,
            'recipientEmail' => $this->recipientEmail,
            'callerNumber' => $this->callerNumber,
            'callerName' => $this->callerName,
            'callerDate' => $this->callerDate,
            'subject' => $this->subject,
            'message' => $this->text,
            //'selectedUser' => $this->selectedUser,
        ]);

        // Falls die Notiz mit einem CallLog verknüpft ist, setzen wir "Note" auf true
        if ($this->callId) {
            CallLog::where('id', $this->callId)->update(['Note' => true]);
            logger()->info("Call-ID {$this->callId}: Feld 'Note' auf true gesetzt.");
        }

        // Bestätigung für den Nutzer (Toast oder Log)

       $this->success('Notiz erfolgreich gespeichert.', timeout: 5000);

        // Modal schließen
        $this->dispatch('closeTelNote');
        $this->clearForm();
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
        return view('livewire.tel-note-create',[
        'config' => $this->configTiny(),
            'messages' => $this->messages,]);
    }
}

<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Services\eCallSMS;
use Mary\Traits\Toast;
use Spatie\Permission\Exceptions\UnauthorizedException;


class SendSMS extends Component
{

    use Toast;

    public $from;
    public $to;
    public $text;
    public $response;

    public function updatedTo($value)
    {
        // Nummer formatieren, wenn sie geändert wird
        $this->to = $this->formatPhoneNumber($value);
    }

    private function formatPhoneNumber($number)
    {
        // Nummer auf das gewünschte Format prüfen
        if (preg_match('/^0\d{9}$/', $number)) {
            return '0041' . substr($number, 1); // "0" durch "0041" ersetzen
        }
        return $number; // Unveränderte Rückgabe, falls nicht im erwarteten Format
    }

    public function mount()
    {
        if (!Auth::user() || !Auth::user()->hasRole('dispo')) {
            throw new UnauthorizedException(403, 'Du hast keine Berechtigung für diese Seite.');
        }

        // Standardwert für das 'from'-Feld setzen
        $this->from = '0041764766627'; // Beispielnummer
    }
    public function sendSms(eCallSMS $service)
    {
        $this->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'text' => 'required|string|max:160',
        ]);

        try {
            $this->response = $service->sendSms($this->from, $this->to, $this->text, 'message2');
            $this->success('SMS erfolgreich gesendet!',  timeout: 5000);
        } catch (\Exception $e) {
            $this->error('Fehler beim Senden der SMS!', description: $e->getMessage(),  timeout: 10000);
        }
    }

    public function render()
    {
        return view('livewire.send-sms');
    }
}

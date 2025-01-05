<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\eCallSMS;

class SendSMS extends Component
{
    public $data; // Variable für die Daten

    public function sendSms(eCallSMS $service)
    {
        $from = '0041769999999';
        $to = '0041768888888';
        $text = 'Hello eCall world :)';

        $response = $service->sendSms($from, $to, $text, 'message'); // 'send-sms' ist der API-Endpoint
        dd($response); // Debugging
    }

    public function render()
    {
        return view('livewire.send-sms', [
            'data' => $this->data,
        ]);
    }
}

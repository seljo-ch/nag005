<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\eCallSMS;

class SendSMS extends Component
{
    public $data; // Variable für die Daten

    public function fetchData(eCallSMS $apiService)
    {
        $this->data = $apiService->fetchData('message');
    }


    public function render()
    {
        return view('livewire.send-sms', [
            'data' => $this->data,
        ]);
    }
}

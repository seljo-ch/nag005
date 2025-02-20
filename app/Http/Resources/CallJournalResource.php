<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CallJournalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'callerNumber' => $this->callerNumber,
            'callerDisplayName' => $this->callerDisplayName,
            'adUser' => $this->adUser,
            'adUserEmail' => $this->adUserEmail,
            'timestamp' => $this->timestamp
        ];
    }
}

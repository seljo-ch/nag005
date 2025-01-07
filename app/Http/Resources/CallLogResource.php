<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CallLogResource extends JsonResource
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
            'CallerNumber' => $this->CallerNumber,
            'CallerDisplayName' => $this->CallerDisplayName,
            'ADUser' => $this->ADUser,
            'Email' => $this->Email,
            'Timestamp' => $this->Timestamp,
        ];
    }
}

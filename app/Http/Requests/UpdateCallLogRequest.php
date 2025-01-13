<?php

namespace App\Http\Requests;

class UpdateCallLogRequest extends StoreCallLogRequest
{
    public function rules(): array
    {
        return [
            'CallerNumber' => 'string',
            'CallerDisplayName' => 'string',
            'ADUser' => 'string',
            'Email' => 'nullable|email',
            'Timestamp' => 'nullable|date_format:Y-m-d H:i:s',  // Gleiche Validierung für Update
        ];
    }
}


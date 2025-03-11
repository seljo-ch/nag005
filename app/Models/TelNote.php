<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'call_id',
        'senderEmail',
        'recipientEmail',
        'callerNumber',
        'callerName',
        'callerDate',
        'subject',
        'message'
    ];
    public function callLog()
    {
        return $this->belongsTo(CallLog::class, 'call_id');
    }
}


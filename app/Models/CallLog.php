<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'CallerNumber', 'CallerDisplayName', 'ADUser', 'Email','Note', 'Timestamp',
    ];

    protected $casts = [
        'Note' => 'boolean',
    ];
}

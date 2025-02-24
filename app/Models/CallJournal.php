<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallJournal extends Model
{
    use HasFactory;

    protected $fillable = [
        'callerNumber',
        'callerDisplayName',
        'adUser',
        'adUserEmail',
        'note',
        'timestamp'
    ];
}

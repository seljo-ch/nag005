<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortNote extends Model
{
    use HasFactory;

    protected $fillable = ['call_journal_id', 'note'];

    public function callJournal()
    {
        return $this->belongsTo(CallJournal::class);
    }
}

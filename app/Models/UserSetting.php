<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'show_forwarding',
        'edit_forwarding',
        'disable_forwarding',
        'show_shortnotes',
        'edit_own_shortnotes_only',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

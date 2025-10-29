<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;

class ChMessage extends Model
{
    use UUID;

    protected $table = 'ch_messages';

    protected $fillable = [
        'from_id', 'to_id', 'seen'
    ];
    const MESSAGE_SEEN = 1;
    const MESSAGE_NOT_SEEN = 0;
}

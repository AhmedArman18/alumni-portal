<?php

namespace App\Models;

use App\Traits\CommonGlobal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
        'path',
        'image_type',
        'attachable_id',
        'attachable_type',
        'uploaded_by',
        'updated_by',
        'deleted_by',
    ];


    public function parentTable()
    {
        return $this->morphTo();
    }
}

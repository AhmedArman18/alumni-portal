<?php

namespace App\Models;

use App\Traits\CommonGlobal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    use CommonGlobal;

    protected $tablename = "events";

    protected $primaryKey = "id";

    protected $hidden = ['created_by', 'updated_by', 'deleted_by'];

    protected $dates = ['start_at', 'end_at'];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    protected $fillable = ['title', 'description', 'start_at', 'end_at', 'location', 'event_type_id', 'created_by', 'updated_by', 'deleted_by'];

    protected $appends = ['event_type', 'created_by_name', 'updated_by_name', 'deleted_by_name'];

    const EVENT_TYPES = [
        '1' => 'Alumni Meet',
        '2' => 'Seminar',
        '3' => 'Conference',
        '4' => 'Workshop',
        '5' => 'Training',
        '6' => 'Fresher Orientation',
        '7' => 'Convocation',
        '8' => 'Other'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('location', 'like', '%' . $search . '%');
    }

    public function getEventTypeNameAttribute()
    {
        return self::EVENT_TYPES[$this->event_type_id];
    }

    public function getCreatedByNameAttribute()
    {
        return $this->createdBy()->first()->name;
    }

    public function getUpdatedByNameAttribute()
    {
        return $this->updatedBy()->first()->name;
    }

    public function getDeletedByNameAttribute()
    {
        return $this->deletedBy()->first()->name;
    }
}

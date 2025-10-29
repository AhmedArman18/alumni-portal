<?php

namespace App\Models;

use App\Traits\CommonGlobal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    use CommonGlobal;

    protected $table = "donations";

    protected $primaryKey = "id";

    protected $hidden = ['created_by', 'updated_by', 'deleted_by', 'user_id'];

    protected $dates = [];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    protected $fillable = [
        'title',
        'description',
        'contact_number',
        'amount',
        'status',
        'user_id',
        'updated_by',
        'deleted_by',
    ];

    protected $appends = [
        'status_label',
        'created_by_name',
        'updated_by_name',
        'deleted_by_name',
    ];

    const STATUSES = [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ];

    /**
     * Scope for searching donations by title, description, or contact number.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('contact_number', 'like', '%' . $search . '%');
    }

    /**
     * Accessor for human-readable status label.
     */
    public function getStatusLabelAttribute()
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Accessor for creator name (using CommonGlobal relationship).
     */
    public function getCreatedByNameAttribute()
    {
        $creator = $this->createdBy()->first();
        return $creator ? $creator->name : 'N/A';
    }

    /**
     * Accessor for updater name (using CommonGlobal relationship).
     */
    public function getUpdatedByNameAttribute()
    {
        $updater = $this->updatedBy()->first();
        return $updater ? $updater->name : 'N/A';
    }

    /**
     * Accessor for deleter name (using CommonGlobal relationship).
     */
    public function getDeletedByNameAttribute()
    {
        $deleter = $this->deletedBy()->first();
        return $deleter ? $deleter->name : 'N/A';
    }

    /**
     * Relationship to the user who created the donation.
     * (Assumes user_id is used as created_by; adjust if needed.)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
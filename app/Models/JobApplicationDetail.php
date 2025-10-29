<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplicationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_path',
        'linkedin_url',
        'github_url',
        'portfolio_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'applied_by', 'id')->withDefault();
    }

    public function jobBoard(): BelongsTo
    {
        return $this->belongsTo(JobBoard::class, 'job_board_id', 'id')->withDefault();
    }
}

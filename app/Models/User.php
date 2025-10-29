<?php

namespace App\Models;

use App\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'batch_number',
        'passing_year',
        'department_id',
        'student_id_number',
        'phone',
        'address',
        'avatar',
        'role_id',
        'type',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateBatchNumbers(): array
    {
        $batchNumbers = [];

        $counter = 1;
        for ($i = 100; $i <= 230; $i++) {
            $batchNameDay = $i . " Day";
            $batchNameEve = $i . " Evening";

            $batchNumbers[$counter++] = $batchNameDay;
            $batchNumbers[$counter++] = $batchNameEve;

        }
        return (collect($batchNumbers)->toArray());
    }

    public function generatePassingYears(): array
    {
        $passingYears = [];

        $counter = 1;
        for ($i = 2003; $i <= now()->format('Y'); $i++) {
            $spring = $i . " Spring";
            $summer = $i . " Summer";
            $fall = $i . " Fall";

            $passingYears[$counter++] = $spring;
            $passingYears[$counter++] = $summer;
            $passingYears[$counter++] = $fall;

        }
        return (collect($passingYears)->toArray());

    }

    public function getDepartments(): array
    {
        return [
            1 => 'CSE',
            2 => 'EEE',
            3 => 'CIV',
            4 => 'BBA',
            5 => 'ENG',
            6 => 'LLB',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id')->withDefault();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'start_date',
        'end_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /// Scopes
    /////////////////////////////////////////////////////////////////////////////////////

    public function scopeWhereUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

}

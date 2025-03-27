<?php

namespace App\Models;

use App\Traits\Searchable;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory,Searchable;


    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'start_date',
        'end_date'
    ];

    protected $perPage = 10;
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

    public function hasRelationToUser(User $user): bool
    {
        return $this->user_id === $user->id;
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /// Filters
    /////////////////////////////////////////////////////////////////////////////////////


    private function filterByStatus($query, $status)
    {
        return $query->when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        });
    }


    private function filterByText($query, $text)
    {
        return $query->when($text, function ($query) use ($text) {
            return $query->where('title' , 'like', "%$text%")
                ->orWhere('description' , 'like', "%$text%");
        });
    }



    /////////////////////////////////////////////////////////////////////////////////////
    /// Accessors
    /////////////////////////////////////////////////////////////////////////////////////


    public function userName(): Attribute
    {
        return Attribute::make(get: fn() => $this->user?->name);
    }


}

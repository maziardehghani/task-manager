<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
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

    protected function scopeSearch($query, array $params): void
    {
        foreach ($params as $key => $value) {
            $query->filter($key, $value);
        }
    }

    public function scopeFilter($query, $methodName, $arguments)
    {
        if (method_exists($this, "filterBy$methodName")) {
            return call_user_func_array([$this, "filterBy$methodName"], [$query, $arguments]);
        }
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


}

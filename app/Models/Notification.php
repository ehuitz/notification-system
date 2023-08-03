<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
            )
        );

        if (array_key_exists('status', $filters)) {
            if ($filters['status'] === 'all')
                $stat = false;
            else
                $stat = $filters['status'];
        }

        $query->when($stat ?? '1,2,3,4,5,6,7,8,9,10', fn($query, $status) =>
            $query->whereHas('status', fn($query) =>
                $query->whereIn('id', explode(',', $status))
            )
        );


    }

    /**
     * Get the status that owns the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }


    /**
     * Get the owner that owns the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}

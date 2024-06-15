<?php

namespace App\Models;

use App\PostType;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function casts(): array
    {
        return [
            'type' => PostType::class,
            'show_on_featured' => 'boolean'
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeFilters($query, $filters = [])
    {
        $query->when($filters['title'] ?? false, fn($query, $title) =>
            $query->where('title', 'LIKE', "%$title%"));

        $query->when($filters['type'] ?? false, fn($query, $type) =>
            $type ? $query->where('type', $type) : $query);

        $query->when($filters['edited'] ?? false, fn($query, $edited) =>
            $edited != ''
            ? $query->where('created_at', $edited ? '=' : '!=', 'updated_at')
            : $query);

        // Date between
        if (isset($filters['date1']) && isset($filters['date2'])) {
            $date_between = [$filters['date1'], $filters['date2']];
        }
        $query->when($date_between ?? false, fn($query, $date_between) =>
            $query->whereBetween('created_at', $date_between));
    }

}

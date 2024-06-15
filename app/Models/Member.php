<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function scopeFilters($query, $filters = [])
    {
        $query->when($filters['name'] ?? false, fn($query, $name) =>
            $query->where('name', 'LIKE', "%$name%"));

        $query->when($filters['phone'] ?? false, fn($query, $phone) =>
            $query->where('phone', 'LIKE', "%$phone%"));

        $query->when($filters['address'] ?? false, fn($query, $address) =>
            $query->where('address', 'LIKE', "%$address%"));
    }

}

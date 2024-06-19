<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\PhotoHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function family()
    {
        return $this->hasMany(Member::class, 'member_id');
    }

    function family_head()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    function photo_histories()
    {
        return $this->hasMany(PhotoHistory::class)->latest();
    }

    function staff_histories()
    {
        return $this->hasMany(StaffHistory::class)->latest();
    }

    // custom properties
    protected function getAgeAttribute()
    {
        return Carbon::parse($this->birth)->age;
    }

    function getLastPositionTimeAttribute()
    {
        return $this->staff_histories()->latest()?->first()->created_at ?? null;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_dead' => 'boolean',
            'joined_at' => 'date:Y-m-d',
            'age' => 'date:Y-m-d'
        ];
    }


    function scopeFilters($query, $filters = [])
    {
        $query->when($filters['name'] ?? false, fn($query, $name) =>
            $query->where('name', 'LIKE', "%$name%"));

        $query->when($filters['phone'] ?? false, fn($query, $phone) =>
            $query->where('phone', 'LIKE', "%$phone%"));

        $query->when($filters['address'] ?? false, fn($query, $address) =>
            $query->where('address', 'LIKE', "%$address%"));

        $query->when($filters['position'] ?? false, fn($query, $pos) =>
            $query->where('position', $pos));
    }

}

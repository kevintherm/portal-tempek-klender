<?php

namespace App\Models;

use App\Models\Member;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffHistory extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function findByRoleId($id)
    {
        return StaffHistory::where('role_id', $id)->get();
    }

    public static function findByMemberId($id)
    {
        return StaffHistory::where('member_id', $id)->get();
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    protected $guarded = ['id'];


}

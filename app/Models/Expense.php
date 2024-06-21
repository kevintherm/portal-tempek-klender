<?php

namespace App\Models;

use App\Models\Post;
use App\PostType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function activity()
    {
        return $this->belongsTo(Post::class, 'post_id')->where('type', PostType::Activity);
    }
}

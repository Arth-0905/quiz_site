<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wrong_question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'check',
    ];

    public function user() {
        return $this->hasMany(User::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}

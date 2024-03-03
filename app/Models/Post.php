<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'path',
        'question',
        'choices',
        'correct_choice',
        'user_id',
    ];

    protected $casts = [
        'choices' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }


}

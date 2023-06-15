<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $fillable = ['id', 'user_id', 'title', 'content','created_at'];
    public $timestamp = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

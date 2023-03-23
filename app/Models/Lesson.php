<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $table = 'lesson';
    protected $fillable = ['id','course_id', 'name','video','gramar','created_at'];
    public $timestamp = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'Course';
    protected $fillable = ['id','name', 'teacher','category','price','description','image','description','total_star','description'];
    public $timestamp = true;
}

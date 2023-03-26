<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    protected $fillable = ['id','name', 'teacher','category','price','description','image','total_star','created_at'];
    public $timestamp = true;
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Define the relationship between Course and Plan models
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
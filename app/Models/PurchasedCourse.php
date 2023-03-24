<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedCourse extends Model
{
    use HasFactory;
    protected $table = 'purchased_course';
    protected $fillable = ['id','course_id', 'user_id','created_at'];
    public $timestamp = true;
}

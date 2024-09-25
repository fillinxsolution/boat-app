<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory , SoftDeletes;


     protected $fillable = ['name','comment','designation','image','is_featured','status','stars'];


    public function getImageAttribute($value)
    {
        return $value ? '/images/testimonials/'.$value : null;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    protected $fillable = ['category_id','supplier_id','name','description','status'];


    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class);
    }

    public function tags()
    {
        return $this->hasMany(ServiceTag::class);
    }




}

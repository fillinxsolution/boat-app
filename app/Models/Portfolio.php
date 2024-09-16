<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;


   protected $fillable = ['supplier_id','category_id','title','yacht_name','location','description','captain_name','captain_email','status'];


    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}

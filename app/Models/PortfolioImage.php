<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;
    protected $table = 'portfolio_images';

    protected $fillable = ['portfolio_id','image'];


    public function getImageAttribute($value)
    {
        return $value ? '/images/portfolio/images/'.$value : null;
    }


    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
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

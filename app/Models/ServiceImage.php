<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    use HasFactory;

    protected $table = 'service_images';

    protected $fillable = ['service_id','image'];


    public function getImageAttribute($value)
    {
        return $value ? '/images/service/images/'.$value : null;
    }


    public function service()
    {
        return $this->belongsTo(Service::class);
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

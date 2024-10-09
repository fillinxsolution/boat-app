<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;


    protected $fillable = ['title','short_description','for_captains','for_supplier','for_captain_video','for_supplier_video','our_aim','background_image'];

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


    public function getBackgroundImageAttribute($value)
    {
        return $value ? '/images/aboutUs/'.$value : null;
    }

}

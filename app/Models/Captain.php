<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Captain extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id','banner_image','company_name','director_name','address',
        'vat_number','sector','description','boat_registration_papers','insurance',
        'status','reason','captain_status' ,'captain_email'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getBoatRegistrationPapersAttribute($value)
    {
        return $value ? '/documents/captains/documents/boatRegistration/'.$value : null;
    }

    public function getInsuranceAttribute($value)
    {
        return $value ? '/documents/captains/documents/insurance/'.$value : null;
    }

    public function getBannerImageAttribute($value)
    {
        return $value ? '/images/users/bannerImages/'.$value : null;
    }


    /**
     * Belongs to user field.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class,'supplier_id');
    }
}

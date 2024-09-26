<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id','banner_image','company_name','director_name','address',
        'vat_number','sector','description','company_registry','liability_insurance','status','reason'
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

    public function getLiabilityInsuranceAttribute($value)
    {
        return $value ? '/documents/supplier/documents/liability/'.$value : null;
    }

    public function getCompanyRegistryAttribute($value)
    {
        return $value ? '/documents/supplier/documents/companyRegistry/'.$value : null;
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


}

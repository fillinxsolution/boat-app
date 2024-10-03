<?php

namespace App\Models;

use App\Traits\LogsChangesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class Plan extends Model
{
    use  HasFactory ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'monthly_charges',
        'annual_charges',
        'description',
        'bullets',
        'status',
        'image',
        'is_popular',
        'default'
    ];

    public function getImageAttribute($value)
    {
        return $value ? '/images/plans/'.$value : null;
    }

    /**
     * Set the default attribute.
     */
    public function setDefaultAttribute($default): void
    {

        Plan::where('default', 1)->update(['default' => 0]);
        $this->attributes['default'] = $default;
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}

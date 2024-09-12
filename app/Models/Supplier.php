<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','banner_image','company_name','director_name','address',
        'vat_number','sector','description','company_registry','liability_insurance','status','reason'];





}

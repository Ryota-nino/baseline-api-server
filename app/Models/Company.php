<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'frigana',
        'company_name',
        'business_description',
        'number_of_employees',
        'logo_path',
        'company_url'
    ];

    public function prefectures()
    {
        return $this->belongsToMany(Prefecture::class, 'company_prefectures');
    }
}

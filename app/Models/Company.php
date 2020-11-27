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

    protected $hidden = ['logo_path'];
    protected $appends = ['logo_image_url'];

    public function prefectures()
    {
        return $this->belongsToMany(Prefecture::class, 'company_prefectures');
    }

    public function getLogoImageUrlAttribute()
    {
        return asset($this->logo_path);
    }

    public function company_information()
    {
        return $this->hasMany(CompanyInformation::class);
    }
}

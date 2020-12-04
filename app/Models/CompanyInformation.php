<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'internship_id',
        'occupational_category_id',
    ];

    public function my_activities()
    {
        return $this->hasMany(MyActivity::class, 'company_information_id');
    }

    public function selections()
    {
        return $this->hasMany(Selection::class);
    }

    public function company_comments()
    {
        return $this->hasMany(CompanyComment::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function occupational_category()
    {
        return $this->hasOne(OccupationalCategory::class, 'id', 'occupational_category_id');
    }

}

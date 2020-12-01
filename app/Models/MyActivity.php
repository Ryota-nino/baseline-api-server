<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'posted_year'
    ];

    public $timestamps = false;

    public function compony_informations()
    {
        return $this->hasMany(CompanyInformation::class, 'id');
    }
}

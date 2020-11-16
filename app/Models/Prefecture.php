<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $hidden = ['pivot'];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_prefectures');
    }
}

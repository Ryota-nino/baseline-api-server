<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'official_offer',
        'decision_offer',
        'occupatioal_category_id',
    ];
}

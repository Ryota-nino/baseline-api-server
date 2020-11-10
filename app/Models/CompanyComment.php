<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_information_id',
        'comment_content',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'interview_id',
        'content'
    ];
}

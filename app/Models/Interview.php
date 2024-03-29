<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'step',
        'results',
        'interview_date',
    ];

    public function interview_contents()
    {
        return $this->hasMany(InterviewContent::class);
    }
}

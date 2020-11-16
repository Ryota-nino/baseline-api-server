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

    public function users()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}

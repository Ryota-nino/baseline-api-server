<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_number',
        'first_name',
        'last_name',
        'sex',
        'annual',
        'year_of_graduation',
        'icon_image_path',
        'desired_occupations',
        'privilege',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'graduation_flag'
    ];

    public function getGraduationFlagAttribute()
    {
        $current_date = Carbon::now();
        $graduation_date = Carbon::parse($this->year_of_graduation);

        return $graduation_date->lte($current_date);
    }

    public function desired_occupation()
    {
        return $this->belongsTo(OccupationalCategory::class, 'desired_occupations', '');
    }

    public function company_information()
    {
        return $this->hasMany(CompanyInformation::class);
    }
}

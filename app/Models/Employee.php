<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


class Employee extends Model implements JWTSubject
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'emp_first_name',
        'emp_last_name',
        'email',
        'password',
        'birth_date',
        'phone',
        'address',
        'employee_gender',
        'is_employee',
        'job_title',
        'salary',
    ];

    // public function sales_operation()
    // {
    //     return $this->hasMany(Sales_Operation::class, 'employee_id');
    // }

    protected $guard_name = 'employee';


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

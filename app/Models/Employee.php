<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ecoma_number',
        'ecoma_type',
        'ecoma_expiry',
        'contact',
        'nationality',
        'job_title',
        'company_site',
        'employee_id',
        'email',
        'bank_name_code',
        'bank_address',
        'account'
    ];

    public function visa()
    {
        return $this->hasMany(Visa::class, 'employee_id');
    }

}

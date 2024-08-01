<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'manager',
        'start_date',
        'address',
        'contact'
    ];

    public function houry_rates(){
        return  $this->hasMany(HourlyRate::class, 'project_id');
    }

}

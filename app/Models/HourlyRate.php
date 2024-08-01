<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourlyRate extends Model
{
    use HasFactory;
    protected $fillable = ['project_id' ,'employee_type', 'hourly_rate'];

    public function projects(){
        return  $this->belongsTo(Project::class, 'project_id');
    }

    public function employee_types(){
        return  $this->hasMany(Project::class, 'employee_type_id');
    }
}

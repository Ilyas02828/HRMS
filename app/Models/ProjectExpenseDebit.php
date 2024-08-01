<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectExpenseDebit extends Model
{
    use HasFactory;
    protected $fillable = ['project_id','date','description','amount', 'month'];
    public function projects(){
        return  $this->belongsTo(Project::class, 'project_id');
    }
}

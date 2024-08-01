<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectExpenseCredit extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'invoice_number', 'month', 'date', 'amount', 'status'];

    public function projects(){
        return  $this->belongsTo(Project::class, 'project_id');
    }
}

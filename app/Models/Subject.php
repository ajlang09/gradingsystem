<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    public function classes()
    {
        return $this->belongsToMany('App\Models\ClassesRecord','class_record_subject', 'subject_id', 'class_id');
    }
}

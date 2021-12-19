<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'year',
        'user_id',
    ];

    public function classes()
    {
        return $this->belongsToMany('App\Models\ClassesRecord','class_record_subject', 'subject_id', 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

}

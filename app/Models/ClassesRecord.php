<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ClassesRecord extends Authenticatable

{
    protected $primaryKey = 'class_id';
    protected $fillable = [
        'class_id',
        'class_name',
        'students'
        
    ];
//many to many connecting to other database
    public function student()
    {
        return $this->belongsToMany('App\Models\StudentRecord','class_id_stud_id', 'id', 'stud_id');
    }
}

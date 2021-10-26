<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
//in order to use auth login extend authenticatable
class StudentRecord extends Authenticatable

{
    protected $fillable = [
        'stud_id',
        'name',
        'contact_no',
        'yearandsection',
        'email'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'name',
        'percentage',
    ];

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
}

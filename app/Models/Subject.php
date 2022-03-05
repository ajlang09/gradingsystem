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

    public function configurations()
    {
        return $this->hasMany('App\Models\SubjectConfiguration');
    }

    public function getConfiguration()
    {
        $breakDown = [
            [
                'label' => 'Class standing',
                'slug' => 'class_standing',
                'percentage' => 0.6,
            ],
            [
                'label' => 'Major exams',
                'slug' => 'major_exams',
                'percentage' => 0.3,
            ],
            [
                'label' => 'Studentship',
                'slug' => 'studentship',
                'percentage' => 0.1,
            ],
        ];


        $configurations = $this->configurations()->get();

        if (!sizeof($configurations)) {
            return $breakDown;
        }

        $breakDown = [];

        foreach ($configurations as $config) {
            $breakDown[] = [
                'label' => $config->name,
                'slug' =>  implode('_', explode(' ', strtolower($config->name))),
                'percentage' => $config->percentage / 100,
            ];
        }

        return $breakDown;
    }

}

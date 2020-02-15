<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    public static $validation_rules = [
        'email' =>'required|email',
        'nidn' => 'required',
        'name' => 'required',
        'nik'  => 'required',
        'birthday' => 'required',
        'birthplace' => 'required',
        'photo' => 'file|image'
    ];

    protected $guarded=[];

    protected $dates = ['birthdate'];

    public $incrementing = false;

    public function user(){
        return $this->hasOne(User::class, 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function getEmailAttribute($value)
    {
        return optional($this->user)->email;
    }

    public function getPhotoPath(){
        if($this->photo != null){
            return 'storage/photo/lecturer/'.$this->photo;
        }
        return 'img/default-user.png';
    }

    public function thesisTrial()
    {
        return $this->belongsToMany(ThesisTrial::class, 'thesis_examiners', 'lecturer_id', 'thesis_trial_id');
    }


    public function thesis()
    {
        return $this->belongsToMany(Thesis::class, 'thesis_supervisors', 'lecturer_id', 'thesis_id');
    }

}

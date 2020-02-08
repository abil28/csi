<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theses extends Model
{
    protected $table = 'theses';

    public function thesisTrial()
    {
    	return $this->hasOne(ThesisTrial::class, 'thesis_id');
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
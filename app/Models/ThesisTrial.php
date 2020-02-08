<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThesisTrial extends Model
{
	protected $fillable = ["thesis_id", "status", "file_report", "registered_at"];

	public function theses()
	{
		return $this->belongsTo(Theses::class, 'thesis_id');
	}

}
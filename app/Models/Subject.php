<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['year_id', 'subject_name'];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}

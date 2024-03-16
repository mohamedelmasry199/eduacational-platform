<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question','type' ,'source','comment'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}

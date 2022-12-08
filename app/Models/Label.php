<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;
    protected $with = ['contacts'];

    public function contacts(){
        return $this->belongsToMany(Contact::class);
    }
}


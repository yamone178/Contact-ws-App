<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\Store;

class StoreContact extends Model
{
    use HasFactory;

    protected $fillable=['id','firstName','lastName','phone','image','email','jobTitle','user_id','isAccepted',];


    public function changeToArray() {
        $contact= StoreContact::all();
        return $contact->toArray();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['id','firstName','lastName','phone','email','jobTitle','user_id'];

    public static function getFirstLetter($word){
        $words = explode(" ", $word);


        $fLetter =  "";

        $fLetter .= $words[0][0];



        return $fLetter;
    }

    public static function randBackgroundColor(){
        $background_colors = array('#282E33', '#25373A', '#164852', '#495E67', '#FF3838');

        $count = count($background_colors)-1;
        $randNumber=rand(0,$count);
        $randBgColor= $background_colors[$randNumber];
        return $randBgColor;
    }



}

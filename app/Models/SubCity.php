<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SubCity extends Model
{

    public $table = "sub_citys";

    public function city(){
        return $this->belongsTo(City::class);
    }
}

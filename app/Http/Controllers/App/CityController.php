<?php


namespace App\Http\Controllers\App;


use App\Models\City;
use App\Models\SubCity;

class CityController extends \App\Http\Controllers\Controller
{

    public function index(){
        return response()->json([
            "error" => false,
            "message" => null,
            "data" => City::orderby("name" , "ASC")->get([
                'id' , 'name'
            ])
        ]);
    }

    public function showCity($city){
        return response()->json([
            "error" => false,
            "message" => null,
            "data" => SubCity::where("city_id" , $city)->orderby("name" , "ASC")->get([
                'id' , 'name' , 'price'
            ])
        ]);
    }

}
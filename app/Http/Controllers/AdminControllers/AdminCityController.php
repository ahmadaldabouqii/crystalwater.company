<?php


namespace App\Http\Controllers\AdminControllers;


use App\Models\City;
use App\Models\Core\Setting;
use App\Models\SubCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AdminCityController extends \App\Http\Controllers\Controller
{
    public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }

    public function city(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingCitys"));

        $result = array();
        $message = array();

        $data = City::get();

        $result['message'] = $message;
        $result['city'] = $data;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.city.index", $title)->with('result', $result);
    }

    public function addCity(){

        $result = array();
        $message = array();

        $result['message'] = $message;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.city.create")->with('result', $result);
    }

    public function storeCity(Request  $request){
        $request->validate([
            "name" => "required"
        ]);

        $cite = new City;
        $cite->name = $request->name;
        $cite->save();
        return redirect("/admin/city");
    }

    public function editCity(Request $request , $id){
        $city = City::find($id);
        $result = array();
        $message = array();

        $result['message'] = $message;
        $result['city'] = $city;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.city.edit")->with('result', $result);
    }

    public function updateCity(Request $request , $id){
        $request->validate([
            "name" => "required"
        ]);

        $cite =  City::find($id);
        $cite->name = $request->name;
        $cite->save();
        return redirect("/admin/city");
    }

    public function deleteCity(Request $request)
    {
        $city = City::find($request->sliders_id);
        $city->delete();
        return redirect()->back()->withErrors([Lang::get("Deleted City")]);
    }


    public function subCity(){

        $result = array();
        $message = array();

        $data = SubCity::get();

        $result['message'] = $message;
        $result['zone'] = $data;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.city.sub.index")->with('result', $result);
    }

    public function addSubCity(){
        $result = array();
        $message = array();

        $result['message'] = $message;
        $result['city'] = City::get();

        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.city.sub.cretae")->with('result', $result);
    }

    public function storeSubCity(Request  $request){
        $request->validate([
            "name" => "required",
            "price" => "required",
            "city_id" => "required",
        ]);

        $zone = new SubCity;
        $zone->city_id = $request->city_id;
        $zone->name = $request->name;
        $zone->price = $request->price;
        $zone->ordering = 1;
        $zone->save();
        return redirect("/admin/sub-city");
    }

    public function editSubCity(Request $request , $id){
        $zone = SubCity::find($id);
        $result = array();
        $message = array();

        $result['message'] = $message;
        $result['city'] = City::get();
        $result['zone'] = $zone;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.city.sub.edit")->with('result', $result);
    }

    public function updateSubCity(Request $request , $id){
        $request->validate([
            "name" => "required",
            "price" => "required",
            "city_id" => "required",
        ]);

        $zone = SubCity::find($id);
        $zone->city_id = $request->city_id;
        $zone->name = $request->name;
        $zone->price = $request->price;
        $zone->ordering = 1;
        $zone->save();

        return redirect("/admin/sub-city");
    }


    public function deleteSubCity(Request $request){
        $zone = SubCity::find($request->sliders_id);
        $zone->delete();
        return redirect()->back()->withErrors([Lang::get("Deleted City")]);
    }
}

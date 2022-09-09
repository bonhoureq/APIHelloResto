<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RestaurantsResource;

class RestaurantController extends Controller
{
    public function show($id)
    {
        $restaurants = Restaurant::all();

        return response()->json($restaurants, "200");
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'description' => 'required|max:255',
            'grade' => 'required',
            'localization' => 'required|max:255',
            'phone_number' => 'required|max:22',
            'website' => 'required|max:255',
            'hours' => 'required|max:255'
        ]);

        $validated = $validator->validated();
       
        $restaurant = Restaurant::create($validated);
        return response()->json([
           "data"=>RestaurantsResource::make($restaurant)
        ],201);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|max:45',
            'description' => 'required|max:255',
            'grade' => 'required',
            'localization' => 'required|max:255',
            'phone_number' => 'required|max:22',
            'website' => 'required|max:255',
            'hours' => 'required|max:255'
        ]);

        if ($request->accepts($validated)) {
            $new = DB::table('restaurants')
                ->where('id', "=", $id)
                ->update([
                    "name" => $request['name'],
                    "description" => $request['description'],
                    "grade" => $request['grade'],
                    "localization" => $request['localization'],
                    "phone_number" => $request['phone_number'],
                    "website" => $request['website'],
                    "hours" => $request['hours'],
                ]);
            return response()->json("200");
        }
        return response()->json("400");
    }

    public function destroy(Restaurant $restaurant, $id)
    {
        $new = DB::table('restaurants')->where('id', "=", $id)->get();
        $restaurant->delete();
        if ($restaurant->delete($id)) {
            return response()->json("200");
        }
        return response()->json("400");
    }
}

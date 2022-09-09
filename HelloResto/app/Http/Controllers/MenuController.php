<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function show($id)
    {
        $menus = Menu::all();

        return response()->json($menus,  "200");
    }

    public function create(Request $request , $restaurant_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'description' => 'required|max:255',
            'price' => 'required',
            'restaurant_id'=> 'unique:restaurants'
        ]);
        $validated = $validator->validated();

        $menu = Menu::create([
            'name' => $request ->name,
            'description' => $request ->description,
            'price' => $request ->price,
            'restaurant_id' => $restaurant_id
        ]);
        return response()->json([
           "data"=>MenuResource::make($menu)
        ],201);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|max:45',
            'description' => 'required|max:255',
            'price' => 'required',
        ]);

        if ($request->accepts($validated)) {
            $new = DB::table('menus')
                ->where('id', "=", $id)
                ->update([
                    "name" => $request['name'],
                    "description" => $request['description'],
                    "price" => $request['price'],
                ]);
            return response()->json( "200");
        }
        return response()->json("400");
    }

    public function destroy(Menu $menu, $id)
    {
        $new = Menu::where('id', '=', $id)->delete();
        if ($new) {
            return response()->json("200");
        }
        return response()->json("400");;
    }
}

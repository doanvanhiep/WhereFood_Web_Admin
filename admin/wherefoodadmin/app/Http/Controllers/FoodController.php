<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodController extends Controller 
{
    public function listFood(Request $request)
    {
        $view=view('listfood')->with('listfood', (array)($request->listfood))->render();
        return response()->json($view,200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        echo response()->json($view,200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
}

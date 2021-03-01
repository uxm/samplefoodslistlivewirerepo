<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class ExampleFoodsListController extends Controller
{
    public function index()
    {
    	// get a bunch of data
    	$foods = Food::all();

    	// turn into array of arrays
    	$foods = $foods->toArray();

    	foreach($foods as $key => $value)
    	{
    		$foods[$key]['moreInfo'] = 'something';
    	}

        return view('exampleFoodsList', ['foods' => $foods]);
    }
}

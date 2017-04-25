<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;
use App\Tag;
use App\Http\Requests;

class PeopleController extends Controller
{
    public function store(Request $request) {
    	People::create($request->all());
    }

    public function show() {
    	$people=People::all()->toArray();
    	$tag=Tag::all()->toArray();
    	$item[0]=$people;
    	$item[1]=$tag;
    	return $item;
    }
}

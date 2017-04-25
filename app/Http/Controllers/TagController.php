<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests;
use Redirect;

class TagController extends Controller
{
    public function store(Request $request) {
    	Tag::create($request->all());
    }

    public function update(Request $request,$id) {
    	Tag::where('id',$id)->update(['name'=>$request->name]);
    	return Redirect::back();
    }
    
    public function show() {
    	$tag=Tag::all()->toArray();
    	return $tag;
    }
}

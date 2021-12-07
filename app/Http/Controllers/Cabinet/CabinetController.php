<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    //
	public function index(Request $request){
		//dd(auth()->user());
		return view('site.cabinet.index');
	}
}

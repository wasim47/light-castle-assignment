<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function __construct() {
       
    }
	
	/////////////////  Action with service provide and class ////////////////////
	public function index(Upload $uploadObject)
    {		
		return view('upload-template');
    }
	
	public function import(Upload $uploadObject)
    {		
		if (request()->isMethod('POST')) {
    		return $uploadObject->store();
		}
		else{
			return redirect()->back()->with('error','Post method not supported');
		}
    }	
}

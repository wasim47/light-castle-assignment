<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Collection;
use App\Service\Upload;

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
	
	
	/////////////////  Action with simple controller ////////////////////
	/*public function getView(Request $req)
    {		
    	return view('upload-template');
    }
		
	
	public function import(Request $req)
    {
		if ($req->hasFile('importfile')) {					////////// Check file is imported or not
			$validator = Validator::make(
			  [
				  'file'      => $req->importfile,
				  'extension' => strtolower($req->importfile->getClientOriginalExtension()),
			  ],
			  [
				  'file'          => 'required',
				  'extension'      => 'required|in:csv,xlsx,xls',
			  ]
			);
	
			$file = $req->file('importfile');			
			$file->move(public_path('import-directory'), $file->getClientOriginalName());			
	
			$files = $file->getClientOriginalName();
			
			$filename = pathinfo($files, PATHINFO_FILENAME);
			$extension = pathinfo($files, PATHINFO_EXTENSION);
			$importfiles = $filename.'.'.$extension;
			if($extension=='csv' || $extension=='xlsx' || $extension=='xls'){
			
				$path = public_path('import-directory').'/'.$importfiles;	
					$collection = (new FastExcel)->import($path);
					$collection1 = collect($collection)->sortBy('timestamp');
					
					$grouped = $collection1->groupBy('group');					
					echo $grouped->toJson(JSON_PRETTY_PRINT);
			}
			else{
				return redirect()->back()->with('error','Please select excel or csv file only');
			}
		}
		else{
			return redirect()->back()->with('error','Please select excel file');
		}
    }*/
	
}

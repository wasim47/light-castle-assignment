<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Collection;

class CommonController extends Controller
{
    public function __construct() {
       
    }
	
	public function index(Request $req)
    {
		
    	return view('upload-template');
    }
	
	public function sampleFileDownload(Request $req)
    {
		$getFile = $req->file_names.'.csv';		
    	$filePath = public_path("samplefiles/".$getFile);		
    	$headers = ['Content-Type: application/csv'];
    	return response()->download($filePath, $getFile, $headers);
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
    }
	
}

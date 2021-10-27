<?php
namespace App\Service;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Collection;
use Validator;

class Upload
{

	
	public function __construct(){
		
	}	
	
	
	public function store(){			
			if (request()->hasFile('importfile')) {					////////// Check file is imported or not
				$validator = Validator::make(
				  [
					  'file'      => request()->importfile,
					  'extension' => strtolower(request()->importfile->getClientOriginalExtension()),
				  ],
				  [
					  'file'          => 'required',
					  'extension'      => 'required|in:csv,xlsx,xls',
				  ]
				);
		
				$file = request()->file('importfile');			
				$file->move(public_path('import-directory'), $file->getClientOriginalName());			
		
				$files = $file->getClientOriginalName();
				
				$filename = pathinfo($files, PATHINFO_FILENAME);
				$extension = pathinfo($files, PATHINFO_EXTENSION);
				$importfiles = $filename.'.'.$extension;
				if($extension=='csv' || $extension=='xlsx' || $extension=='xls'){
				
					$path = public_path('import-directory').'/'.$importfiles;	
						$collection = (new FastExcel)->import($path);			////////// Get Excel data in collection
						$collectedData = collect($collection)->sortBy('timestamp');
						
						$grouped = $collectedData->groupBy('group');					
						$jsonoutput =  $grouped->toJson(JSON_PRETTY_PRINT);		////////// Json Data formatting
						printf("<pre>%s</pre>", $jsonoutput);
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
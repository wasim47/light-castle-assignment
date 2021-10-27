@extends('layouts.master')

@section('content')

	<div class="row">
    	<div class="container">
        	<div class="col-lg-12 col-md-10 col-sm-6 col-xs-12">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Download excel format</label>
                        <a href="#" class="btn btn-warning" onClick="sampleDownload(document.getElementById('filetypes').value)">Click here to download</a>
                    </div>
                    <div class="col-sm-8">
                        <label>Choose your excel file</label>
                        <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-sm-8">
                                <input type="file" name="importfile" class="form-control" />
                                <input type="hidden" name="filetypes" id="filetypes" />
                            </div>
                            <div class="col-sm-4"><button type="submit" class="btn btn-info">Upload</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection
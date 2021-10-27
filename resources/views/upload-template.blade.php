@extends('layouts.master')

@section('content')

	<div class="row">
    	<div class="container center-align">
        	<div class="col-lg-12 col-md-10 col-sm-6 col-xs-12">
                <div class="row">
                    <div class="col-sm-8 offset-4">
                        <label>{{ $label }}</label>
                        <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                            <div class="col-sm-8">
                                <input type="file" name="importfile" class="form-control" />
                            </div>
                            <div class="col-sm-4"><button type="submit" class="btn btn-info">{{ $upload }}</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection
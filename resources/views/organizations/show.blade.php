{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Organization')

@section('content_header')
    <h1>View Organization</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('organization.index') }}"> Back</a>
            </div>
        </div>
    </div>  
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 
    <div class="row">
    <div class="col-md-6 margin-tb pull-left">
        <div class="row">
		      <div class="col-md-1"> <label class='pull-right' for="name">Name:</label></div>
		      <div class="form-group col-md-4">
		        {{ $organization->name }}
		      </div>
		    </div>
		    <div class="row">
		       <div class="col-md-1"> <label class='pull-right' for="Slug">Slug:</label></div>
		      <div class="form-group col-md-4">		        
		        {{ $organization->identifier }}
		      </div>
		    </div>
		    <div class="row">
		       <div class="col-md-1"> <label class='pull-right' for="email">Email:</label></div>
		      <div class="form-group col-md-4">		        
		        {{ $organization->email }}
		      </div>
		    </div>
		    <div class="row">
		       <div class="col-md-1"> <label class='pull-right' for="Phone">Phone:</label></div>
		      <div class="form-group col-md-4">		      
		        {{ $organization->phone }}
		      </div>
		    </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
    	$('#org').on('keyup', function(){
    		var b = $('#org').val().replace(/[^a-z0-9]/gi,'').toLowerCase();
    		$('#org_slug').val(b);
    	});
     </script>
@stop
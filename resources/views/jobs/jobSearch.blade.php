@extends('layouts.app')
@section('title', 'Job Page')

@section('content')
	<div class="main-body-content w-100">
  		<div class="table-responsive bg-light">
  		<h3 style="display:contents">Search Jobs</h3>
  		<form method="post" action="{{route('searchJob')}}">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<div style="display: flex;">
		<input class="form-control bold" type="text" name="search" placeholder="Search Job Name, Description, or Location" aria-label="Search a Job">
		 <input type="submit" value="Save Changes" class="btn btn-primary bold"></div>
		  <p class="bold" style="color: red;">{{ $errors->first('search') }}</p>
		 </form>
  		</div>
  	</div>
@endsection
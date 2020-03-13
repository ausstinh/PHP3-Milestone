@extends('layouts.app')
@section('title', 'Job Page')

@section('content')
	<div class="main-body-content w-100">
  		<div class="table-responsive bg-light">
  		<h3 style="display:contents">Search Jobs</h3>
  		<form method="post" action="{{route('searchJob')}}">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
		<div style="display: flex;">
		<input class="form-control bold" type="text" placeholder="Search" aria-label="Search a Job">
		 <input type="submit" value="Save Changes" class="btn btn-primary bold"></div></form>
  		<table class="table" style="color: black">
  				<tr>
  					<th style="width: 1.7%;">Name</th>
  					<th style="width: 1.7%;">Description</th>
  					<th style="width: 1.7%;">Salary</th>
  					<th>Location</th>	
  				</tr>
  			</table>
  		@foreach ($model as $job)  	
  			<table class="table" style="color: black">
  				<tr>
  					<th style="width: 6%;"><a href="{{route('viewJob', $job->getId())}}">{{$job->getName()}}</a></th>
  					<th style="width: 6%;">{{$job->getDescription()}}</th>
  					<th style="width: 3%;">${{$job->getSalary()}}</th>		
  					<th>{{$job->getLocation()}}</th>		 					
  				    <th><a class="btn btn-primary bold" href="{{ route('apply') }}">Apply</a></th>					
  				</tr>
  			</table>
  		@endforeach
  		</div>
  	</div>
@endsection
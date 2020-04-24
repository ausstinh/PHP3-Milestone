@extends('layouts.app')
@section('title', 'Job Page')

@section('content')
		<!-- View groups information-->
	<div class="main-body-content w-100">
  		<div class="table-responsive bg-light">
  		<h3 style="display:contents">Groups</h3>
  		<a class="btn btn-primary bold" href="{{ route('groupCreate') }}">Create Group</a>
  	    	<table class="table" style="color: black">
  				<tr>
  					<th style="width: 3%;">Name</th>
  					<th>Description</th>
  				</tr>
  			</table>
  		@foreach ($model as $group)  	
  			<table class="table" style="color: black">
  				<tr>
  					<th style="width: 6%;">{{$group->getName()}}</th>
  					<th style="width: 6%;">{{$group->getDescription()}}</th>	 							
  					<th><a class="btn btn-primary bold" href="{{ route('readGroup', $group->getId())}}">View Group</a></th>
  				   	
  				</tr>
  			</table>
  		@endforeach
  		</div>
  	</div>
@endsection
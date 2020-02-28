@extends('layouts.app')
@section('title', 'Experience Page')

@section('content')
	<div class="main-body-content w-100">
  		<div class="table-responsive bg-light">
  		<h3 style="display:contents">Experiences</h3>
  		<a class="btn btn-primary bold" href="{{ route('experienceCreate') }}">Insert Job</a>
  		<a class="btn btn-primary bold" href="{{ route('profile', Session::get('users_id')) }}">Profile</a>
  		<table class="table" style="color: black">
  				<tr>
  					<th  style="width: 1%;">Company</th>
  					<th  style="width: 1%;">Description</th>
  					<th  style="width: 1%;">Location</th>
  					<th  style="width: 1%;">Title</th>
  					<th  style="width: 1%;">Start Date</th> 
  					<th>End Date</th>	
  				</tr>
  			</table>
  		@foreach ($model as $experiences)  	
  			<table class="table" style="color: black">
  				<tr>
  					<th>{{$experiences->getCompany()}}</th>
  					<th>{{$experiences->getDescription()}}</th>
  					<th>{{$experiences->getLocation()}}</th>		
  					<th>{{$experiences->getTitle()}}</th>		
  					<th>{{$experiences->getStartDate()}}</th>		
  					<th>{{$experiences->getEndDate()}}</th>				
  					<th><a class="btn btn-primary bold" href="{{ route('readExperienceEdit', $experiences->getId()) }}">Edit Job</a></th>
  				    <th><a class="btn btn-primary bold" href="{{URL::to('/deleteExperience/'.$experiences->getId()) }}">Delete Job</a></th>					
  				</tr>
  			</table>
  		@endforeach
  		</div>
  	</div>
  	 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
    $(function() {
        $('.confirm').click(function() {
            return window.confirm("Are you sure?");
        });
    });
    </script>
@endsection
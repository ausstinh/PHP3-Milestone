@extends('layouts.app')
@section('title', 'User table Page')

@section('content')

  	<div>
  	<!-- Table to display user attributes -->
  		<div class="table-responsive bg-light">
  		<table class="table" style="color: black">
  				<tr>
  					<th style="width: .3%">Email</th>
  					<th style="width: .2%">First Name</th>
  					<th style="width: .2%">Last Name</th>		
  					<th style="width: .1%">Gender</th>
  					<th style="width: 1%">Role</th>
  					
  				</tr>
  			</table>
  			<!-- foreach to loop through users in database -->
  		@foreach ($model as $user)
  		@if(session()->get('users_id') != $user->getUsers_id())
  			<table class="table" style="color: black">
  				<tr style="text-align: center">
  					<th style="width: 10%">{{$user->getEmail()}}</th>
  					<!-- Retrieve user information -->
  					<th>{{$user->getFirstname()}}</th>
  					<th>{{$user->getLastname()}}</th> 				
  					<th>{{$user->getGender()}}</th>				
  					<th>{{$user->getRole()}}</th>
  					<th><a class="btn btn-primary bold" style="width: 80px; height: 25px; font-size: 10px" href="{{ route('adminProfileEdit', $user->getUsers_id()) }}">Edit Profile</a></th>
  					<!-- Check what state of suspension user is in -->
  					<!-- If user suspend == 0, display suspend button for they are not suspended currently -->
  					@if($user->getSuspend() == 0)
  					<th><a class="btn btn-primary bold" style="width: 80px; height: 25px; font-size: 10px"  href="{{URL::to('/toggleSuspend/'.$user->getUsers_id()) }}">Suspend</a></th>
  					<!-- If user suspend == 1, display unsuspend button for they are currently suspended -->
  					@elseif($user->getSuspend() == 1)
  					<th><a class="btn btn-primary bold" style="width: 80px; height: 25px; font-size: 10px"  href="{{URL::to('/toggleSuspend/'.$user->getUsers_id()) }}">UnSuspend</a></th>
  					@endif
  					<th><a class="btn btn-primary bold confirm" style="width: 80px; height: 25px; font-size: 10px"  href="{{URL::to('/terminate/'.$user->getUsers_id()) }}">Delete</a></th>
  				</tr>
  			</table>
  		@endif
  		@endforeach
  		</div>
  	</div>
 	<!-- Check if user wants to delete user -->
    <script type="text/javascript">
    $(function() {
        $('.confirm').click(function() {
            return window.confirm("Are you sure?");
        });
    });
    </script>
@endsection
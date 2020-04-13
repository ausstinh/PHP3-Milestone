@extends('layouts.app')
@section('title', 'User table Page')

@section('content')
<!-- Same view as adminConrol view except this role cannot suspend, unsuspend or delete user -->
  	<div class="main-body-content w-100">
  		<div class="table-responsive bg-light">
  		<table class="table" style="color: black">
  				<tr>
  					<th>Email</th>
  					<th>First Name</th>
  					<th>Last Name</th>
  					<th>Gender</th>		
  				</tr>
  			</table>
  		@foreach ($model as $user)
  		@if(session()->get('users_id') != $user->getUsers_id())
  			<table class="table" style="color: black">
  				<tr>
  					<th>{{$user->getEmail()}}</th>
  					<th>{{$user->getFirstname()}}</th>
  					<th>{{$user->getLastname()}}</th> 		
  					<th>{{$user->getGender()}}</th>
  					<th><a class="btn btn-primary bold" style="width: 80px; height: 25px; font-size: 10px" href="{{ route('adminProfileEdit', $user->getUsers_id()) }}">Edit Profile</a></th>
  				</tr>
  			</table>
  			@endif
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
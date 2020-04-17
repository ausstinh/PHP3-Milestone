@extends('layouts.app')
@section('title', 'Skills Page')

@section('content')
	<div class="main-body-content w-100">
  		<div class="table-responsive bg-light">
  		<h3 style="display:contents">Skills</h3>
  		<a class="btn btn-primary bold" href="{{ route('skillCreate') }}">Insert Skill</a>
  		<a class="btn btn-primary bold" href="{{ route('profile', Session::get('users_id')) }}">Profile</a>
  		<table class="table" style="color: black">
  				<tr>
  					<th style="width: 1%">Skill</th>
  					<th>Rating</th>	
  				</tr>
  			</table>
  		@foreach ($skills as $skill)
  			<table class="table" style="color: black">
  				<tr>
  					<th>{{$skill->getDescription()}}</th>
  					<th>{{$skill->getRating()}}</th>		
  					<th><a class="btn btn-primary bold" href="{{ route('readSkillEdit', $skill->getId()) }}">Edit Skill</a></th>
  				    <th><a class="btn btn-primary bold" href="{{URL::to('/deleteSkill/'.$skill->getId()) }}">Delete Skill</a></th>										
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
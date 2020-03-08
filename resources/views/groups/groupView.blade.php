@extends('layouts.app')
@section('title', 'View Group') 
@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<body>
	<div class="container emp-profile">
			<!-- View group information -->
			<div class="row">
					<div class="col-sm-3">  <a class="btn btn-primary bold"  href="javascript:history.back()">Go Back</a> 
                         </div>
                         
				    <div class="col-sm-3"></div>
                    <div class="col-sm-4" style="margin-left: 80px">                
                      @if($group->getMembers() != null)
                      @foreach($group->getMembers() as $member)                                              
                          @if($member->getUsers_id() == session()->get('users_id'))
                          	<a class="btn btn-primary bold" style="margin-bottom: 5px;margin-left: 10px;" href="{{ route('leaveGroup', $group->getId()) }}">Leave Group</a>
                              @break
                          @endif                                                
                          @if($loop->last)
                           	<a class="btn btn-primary bold" style="margin-bottom: 5px;margin-left: 10px;" href="{{ route('joinGroup', $group->getId()) }}">Join Group</a>
                          @endif
                        @endforeach
                        @endif
                        @if($group->getMembers() == null)
                         	<a class="btn btn-primary bold" style="margin-bottom: 5px;margin-left: 10px;" href="{{ route('joinGroup', $group->getId()) }}">Join Group</a>
                         @endif
                         @if($group->getRole() == 1)
                          <a class="btn btn-primary bold" href="{{ route('readGroupEdit', $group->getId()) }}">Edit Group</a>     
                          <a class="btn btn-primary bold" href="{{URL::to('/deleteGroup/'.$group->getId()) }}">Delete Group</a>
                       @endif
                                                  
				 </div>
			</div>
			<div class="row" style="margin-top: 30px;">
				<div class="col-md-6">
					<div class="tab-content profile-tab" id="myTabContent">
						<div class="tab-pane fade show active center" id="home"
							role="tabpanel" aria-labelledby="home-tab">					
							<!-- Rows to allow user to edit any information -->
							<div class="row">
								<div class="col-md-3 " style="color: Black">
									<label hidden>Id</label>
								</div>
								<div class="col-md-5 ">
									<div class="input-group form-group" style="width:300px">
										<input type="text" class="form-control bold"
											value="{{$group->getId()}}" name="id" hidden>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Name</label>
								</div>	
								<div class="col-md-5">
							
									<p>{{$group->getName()}}</p>
									 	
								</div>
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Description:</label>
								</div>	
								<div class=>
								<div class="input-group form-group" style="width:300px">
									<p cols="50" style="margin-left: 5%;" class="bold" name="description"  rows="5">{{$group->getDescription()}}</p>
								</div>
								</div>
								<div class="row">
								<div class="main-body-content w-100" style="height:249px; padding-left:0; padding: 15px">
  		<div class="table-responsive bg-light">
  		<div class="col-md-3" style="color: Black">
  		<label style="display:contents">Users</label>
  		</div>
  		 	<table class="table" style="color: black">
  				<tr>
  					<th style="">Name</th>
  				</tr>
  			</table>
				@foreach ($userGroup as $user) 
			<div class="table-responsive bg-light">	
          			<table class="table" style="color: black">
          				<tr>
          					<th style="width: 6%;">{{$user->getUsername()}}</th>
          					 @if($group->getRole() == 1 && $user->getUsers_id() != session()->get('users_id')) 
                          <th><a class="btn btn-primary bold" href="{{URL::to('/terminate/'.$user->getId()) }}">Remove User</a></th>       				 
                          @endif            
          				</tr>
          			</table>
          		@endforeach
          		</div>
				</div>
				</div></div>
			</div>					
		</div>
	</div>
</div>									
			</div>
	</div>
	</body>
</html>
@endsection

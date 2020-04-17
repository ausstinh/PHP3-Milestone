@extends('layouts.app')
@section('title', 'Create Experience') 
@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<body>
	<div class="container emp-profile">
			<!-- Stores user entered information for controller to use using POST method -->
		<form method="post" action="{{ route('updateExperience') }}">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
			<div class="row">
					<div class="col-sm-3"></div>
				    <div class="col-sm-3"></div>
                    <div class="col-sm-4" style="margin-left: 80px; display: flex;">                
                         <input type="submit" value="Save Changes" class="btn btn-primary bold">	     
                          <a class="btn btn-primary bold" style="margin-left: 10px;" href="javascript:history.back()">Cancel Changes</a>                                                      
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
											value="{{$experience->getId()}}" name="id" hidden>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Company</label>
								</div>	
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
									 value="{{$experience->getCompany()}}" name="company">
								</div>
								</div>
							</div>
							 <p class="bold" style="color: red;">{{ $errors->first('company') }}</p>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Description</label>
								</div>	
								<div class="col-md-6">
								<div class="input-group form-group" style="width:300px">
									<textarea cols="50" class="bold" name="description"  rows="5">{{$experience->getDescription()}}</textarea>
								</div>
								</div>
							</div>
							 <p class="bold" style="color: red;">{{ $errors->first('description') }}</p>
						<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Location</label>
								</div>		
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
									value="{{$experience->getLocation()}}"  name="location">
								</div>
								</div>			
							</div>
							 <p class="bold" style="color: red;">{{ $errors->first('location') }}</p>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Title</label>
								</div>
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
									 value="{{$experience->getTitle()}}" name="title">
								</div>
								</div>
							</div>
							 <p class="bold" style="color: red;">{{ $errors->first('title') }}</p>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Start Date</label>
								</div>
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
										value="{{$experience->getStartDate()}}"  name="startdate">
								</div>
								</div>
							</div>
							 <p class="bold" style="color: red;">{{ $errors->first('startdate') }}</p>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>End Date</label>
								</div>
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
										value="{{$experience->getEndDate()}}" name="enddate">
								</div>
								</div>					
							</div>
							 <p class="bold" style="color: red;">{{ $errors->first('enddate') }}</p>
						</div>
					</div>
				</div>									
			</div>
		</form>
	</div>
	</body>
</html>
@endsection

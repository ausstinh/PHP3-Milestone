@extends('layouts.app')
@section('title', 'Create Experience') 
@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<body>
	<div class="container emp-profile">
			<!-- Stores user entered information for controller to use using POST method -->
		<form method="post" action="{{ route('updateJob') }}">
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
											value="{{$job->getId()}}" name="id" hidden>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 " style="color: Black">
									<label hidden>Company_id</label>
								</div>
								<div class="col-md-5 ">
									<div class="input-group form-group" style="width:300px">
										<input type="text" class="form-control bold"
											value="{{$job->getCompany_id()}}" name="company_id" hidden>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Name</label>
								</div>	
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
									 value="{{$job->getName()}}" name="name">
								</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Description</label>
								</div>	
								<div class="col-md-6">
								<div class="input-group form-group" style="width:300px">
									<textarea cols="50" class="bold" name="description"  rows="5">{{$job->getDescription()}}</textarea>
								</div>
								</div>
							</div>
						<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Location</label>
								</div>		
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
									value="{{$job->getLocation()}}"  name="location">
								</div>
								</div>			
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Salary</label>
								</div>
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="number" min="1" step="any" class="form-control bold"
									 value="{{$job->getSalary()}}" name="salary">
								</div>
								</div>
							</div>						
						</div>
					</div>
				</div>									
			</div>
		</form>
	</div>
	</body>
</html>
@endsection

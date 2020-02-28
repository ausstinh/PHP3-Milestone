@extends('layouts.app')
@section('title', 'Create Experience') 
@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<body>
	<div class="container emp-profile">
			<!-- Stores user entered information for controller to use using POST method -->
		<form method="post" action="createExperience">
			<input type="hidden" name="_token" value="<?php echo csrf_token()?>" />
			<div class="row">
					<div class="col-sm-3"></div>
				    <div class="col-sm-3"></div>
                    <div class="col-sm-4" style="margin-left: 80px; display: flex;">                
                         <input type="submit" value="Save Changes" class="btn btn-primary bold">	     
                          <a class="btn btn-primary bold"  href="javascript:history.back()">Cancel Changes</a>                                                      
				 </div>
			</div>
			<div class="row" style="margin-top: 30px;">
				<div class="col-md-6">
					<div class="tab-content profile-tab" id="myTabContent">
						<div class="tab-pane fade show active center" id="home"
							role="tabpanel" aria-labelledby="home-tab">					
							<!-- Rows to allow user to edit any information -->
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Company</label>
								</div>	
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
									 Placeholder="Insert A Company" name="company">
								</div>
								</div>
								{{ $errors->first('company') }}
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Description</label>
								</div>	
								<div class="col-md-6">
								<div class="input-group form-group" style="width:300px">
									<textarea cols="50" class="bold" name="description" Placeholder="Description" rows="5"></textarea>
								</div>
								</div>
								{{ $errors->first('description') }}
							</div>
						<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Location</label>
								</div>		
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
									 Placeholder="Insert A Location" name="location">
								</div>
								</div>	
								{{ $errors->first('location') }}		
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Title</label>
								</div>
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
									 Placeholder="Insert A Title" name="title">
								</div>
								</div>
								{{ $errors->first('title') }}
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>Start Date</label>
								</div>
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
										Placeholder="Insert A Start Date" name="startdate">
								</div>
								</div>
								{{ $errors->first('startdate') }}
							</div>
							<div class="row">
								<div class="col-md-3" style="color: Black">
									<label>End Date</label>
								</div>
								<div class="col-md-5">
								<div class="input-group form-group" style="width:300px">
									<input type="text" class="form-control bold"
										Placeholder="Insert A End Date" name="enddate">
								</div>
								</div>			
								{{ $errors->first('enddate') }}		
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

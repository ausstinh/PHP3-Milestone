@extends('layouts.app') 	
@section('title', 'Home') 

@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<div class="flex-center position-ref full-height">
	<div class="content" style="padding-bottom: 300px">
		<div class="title m-b-md"></div>
		<!-- Home Page to display user who's logged in -->
		<h2 style="font-weight: 700; align-text:center">Welcome {{$model->getFirstName()}} {{$model->getLastName()}}</h2><br>
		@if($jobs == null)
		<h2 style="font-weight: 700">No Jobs Posted Yet!</h2>
		 @elseif($model != null)
		 <div class="flex-container" style="display: flex">
		
        @foreach ($jobs as $card)
        
            <div class="card" style="width: 18rem; height:auto; margin:10px; text-align: center;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                <div class="card-body">
                <div style="display: flex;"> 
                <h2 style="margin-right: 20px">Job:</h2>
                <h4 class="card-text">{{ $card->getName() }}</h4>
                </div>
               <div style="display: flex;"> 
                <h2 style="margin-right: 20px">Details:</h2>
                <h4 class="card-text">{{ $card->getDescription() }}</h4>
                </div>
                <div style="display: flex;"> 
                <h2 style="margin-right: 20px">Location:</h2>
                    <h4 class="card-text" >{{ $card->getLocation() }}</h4>
                </div>
                <div style="display: flex;"> 
                <h2 style="margin-right: 20px">Salary:</h2>
                     <h4 class="card-text">${{ $card->getSalary() }}</h4>
                </div>
                </div>
            </div>
        
    
    @endforeach
    </div>
    @endif
	</div>
</div>
</html>
@endsection

@extends('layouts.app') 	
@section('title', 'Apply') 

@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<div class="flex-center position-ref full-height">
	<div class="content" style="padding-bottom: 300px">
		<div class="title m-b-md"></div>
		<h2 style="font-weight: 700">You Applied for the Job!</h2><br>
		<a href="javascript:history.back()" style="font-weight: 700; color:white">Go Back</a>	
	</div>
</div>
</html>
@endsection

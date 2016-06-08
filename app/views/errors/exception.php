<!DOCTYPE html>
<html>
<head>
	<title>{{$e->getMessage()}}</title>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style>
		body{
			margin:0;
			padding:0;
			font-family: Montserrat;
			background-color : #eee;
		}
		.heading{
			padding:20px;
			background-color: bluegray;
		}
		.desc{
			padding:20px;
			background-color:tomato;
			color:#ffffff;
		}
		.status-code{
			font-size:36px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<h1 class="heading">Booo! Exception Detected!</h1>
	<h3 class="desc">{{$statusCode}} {{$e->getMessage()}}</h3>
	<ol>
	@foreach($e->getTrace() as $index=>$trace)@
		@if(isset($trace['file']))@
			<li> {{$trace['file']}} at line {{$trace['line']}}</li>
		@endif@
	@endforeach@
	</ol>
</body>
</html>

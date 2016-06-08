<!DOCTYPE html>
<html>
<head>
	<title>{{$e[1]}}</title>
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
	</style>
</head>
<body>
	<h1 class="heading">Booo! Error Occurred!</h1>
	<h3 class="desc">{{$e[1]}} in {{$e[2]}} at line {{$e[3]}}</h3>
	<ol>
	@foreach($e[4] as $index=>$trace)@
		<li> {{$trace}}</li>
	@endforeach@
	</ol>
</body>
</html>

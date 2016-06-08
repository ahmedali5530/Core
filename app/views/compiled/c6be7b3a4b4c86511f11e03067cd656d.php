<!DOCTYPE html>
<html>
<head>
	<title><?php echo e($e->getMessage()); ?></title>
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
	<h3 class="desc"><?php echo e($statusCode); ?> <?php echo e($e->getMessage()); ?></h3>
	<ol>
	<?php foreach($e->getTrace() as $index=>$trace): ?>
		<?php if(isset($trace['file'])): ?>
			<li> <?php echo e($trace['file']); ?> at line <?php echo e($trace['line']); ?></li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ol>
</body>
</html>

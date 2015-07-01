<?php
  #Network Informations
$hostname = gethostname();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Web Application">
	<meta name="author" content="">
	<!-- Bootstrap core CSS -->
	<link href="vendor/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="vendor/nostalgiaz/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">

	<!-- HEADER -->
	<title><?php echo $hostname ?></title>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
			<![endif]-->
		</head>
		<body>
			<!-- HEADER -->
			<h1 class="page-header">
				<center>
					<span class="glyphicon glyphicon-camera"></span>
					&nbsp&nbsp
					<a href="http://<?php echo $hostname ?>"><?php echo $hostname ?></a>
				</center>
			</h1>

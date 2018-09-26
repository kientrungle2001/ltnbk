<?php require_once 'bootstrap.php';?><!DOCTYPE html>
<html ng-app="flApp" ng-controller="HomeController">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Fulllook</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome-4.6.3/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
	
	<script>
		FL_API_URL = '<?php echo FL_API_URL?>';
	</script>
</head>
<body>
	<?php include('common/header.php'); ?>
	<?php include('test/trytest.php'); ?>
	<?php include('common/footer.php'); ?>
</body>
</html>
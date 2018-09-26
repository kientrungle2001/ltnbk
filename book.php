<?php require('./bootstrap.php'); ?><!DOCTYPE html>

<html ng-app="flApp" ng-controller="UserBookController">
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
		SOFTWARE = '<?php echo SOFTWARE?>';
		SITE = '<?php echo SITE?>';
		sessionUserId = '<?php echo $_SESSION['userId'] ?>';
		userBookId = '<?php echo $_GET['id'] ?>';
	</script>
</head>
<body>
	<?php include('common/header.php'); ?>
	<?php include('profile/book.php'); ?>	
	<?php include('common/footer.php'); ?>
	<script src="/assets/angular/book.js"></script>
</body>
</html>
<?php require_once 'bootstrap.php';?><!DOCTYPE html>
<html ng-app="flApp" ng-controller="PracticeController">
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
		FL_URL = '<?php echo FL_URL?>';
		SOFTWARE = '<?php echo SOFTWARE?>';
		SITE = '<?php echo SITE?>';
		subject_id = '<?php echo intval($_GET['subject_id']); ?>';
		serverTime = <?php echo time() ?>;
		
		sessionUserId = '<?php if(isset($_SESSION['userId'])) echo $_SESSION['userId']  ?>';
		checkPayment = '<?php if(isset($_SESSION['checkPayment'])) echo $_SESSION["checkPayment"] ?>';
		paymentDate = '<?php if(isset($_SESSION['paymentDate'])) echo $_SESSION["paymentDate"] ?>';
		expiredDate = '<?php if(isset($_SESSION['expiredDate'])) echo $_SESSION["expiredDate"] ?>';

		setInterval(function() {
			serverTime++;
		}, 1000);
	</script>
</head>
<body>
	<?php include('common/header.php'); ?>
	<?php include('practice/detail.php'); ?>
	<?php include('common/footer.php'); ?>
	<script src="/assets/angular/practice.js?t=1"></script>
</body>
</html>

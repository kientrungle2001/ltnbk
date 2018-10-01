<?php require('./bootstrap.php'); ?><!DOCTYPE html>
<html ng-app="flApp" id="GameController" ng-controller="GameController">
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
		/*userId = 8;
		checkPayment = true;*/
	</script>
</head>
<body>
	<?php include('common/header.php'); ?>
	<?php include('game/index.php'); ?>
	<?php include('common/footer.php'); ?>
	<script src="/assets/angular/game.js?t=<?php echo time(); ?>"></script>
	<?php if(isset($_GET['gameType']) && isset($_GET['gameTopic']) && $_GET['gameType'] == 'muatu' ){ ?>
	<script>
		jQuery(function(){

			var $scope = angular.element('#GameController').scope();
			var intervalId = setInterval(function(){
				if(typeof($scope.allWord) != 'undefined'){
					RainWord.init($scope.allWord, $scope.trueWord, $scope.totalWord);
					clearInterval(intervalId);
				}
			}, 100);
			
    		
    	});	
    	
	</script>
	<?php } else if(isset($_GET['gameType']) && isset($_GET['gameTopic']) && $_GET['gameType'] == 'dragWord') { ?>
		<script>
			jQuery(function(){
				
				var $scope = angular.element('#GameController').scope();
				var intervalId = setInterval(function(){
					if(typeof($scope.dataCells) != 'undefined' && $scope.dataTopics != 'undefined'){
						Factorys.initGame($scope.dataCells, $scope.dataTopics);
						Factorys.getGame().start();
						clearInterval(intervalId);
					}
				}, 100);
				
				
			});
		</script>	
	<?php } ?>
</body>
</html>
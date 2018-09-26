<?php 
	session_start();	
	unset($_SESSION["username"]);
	unset($_SESSION["name"]);
	unset($_SESSION["userId"]);
	unset($_SESSION["checkPayment"]);
	unset($_SESSION["paymentDate"]);
	unset($_SESSION["expiredDate"]);	
	header('Location: /');

 ?>
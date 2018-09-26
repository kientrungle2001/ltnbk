<?php 
	header('Content-Type: application/json');
	session_start();
	$dataResult = $_POST;
	
	$_SESSION["checkPayment"] = 1;
	$_SESSION["paymentDate"] = $dataResult['paymentDate'];
	$_SESSION["expiredDate"] = $dataResult['expiredDate'];
	$data = $_SESSION["checkPayment"];
	$rs = array('status' => 1, 'error'=> 0, 'message'=> 'Bạn đã nạp thẻ thành công', 'data'=> $data);
	echo json_encode($rs);

 ?>
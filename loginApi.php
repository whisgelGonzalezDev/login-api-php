<?php
	require_once('dbConfig.php');


	$userName = $_POST['userName'];
	$password = $_POST['password'];


	$loginQuery = "SELECT * FROM `users` WHERE `user_name` = '$userName' AND `password` = '$password'";

	$query = mysqli_query( $dbcon, $loginQuery);

	if (mysqli_num_rows($query) > 0) {
		$userObj = mysqli_fetch_assoc($query);
		$response['status'] = true;
		$response['messsage'] = "Login Sucess";
		$response['data'] = $userObj; 
	} else { 
		$response['status'] = false;
		$response['messsage'] = "User not found"; 
	}




	 header('content-type: application/json; charset=utf-8');
	 echo json_encode($response);
?>
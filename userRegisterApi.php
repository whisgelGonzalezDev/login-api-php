<?php
	require_once('dbConfig.php');
	 header('content-type: application/json; charset=utf-8');

	$fullName = $_POST['fullName'];
	$userName = $_POST['userName'];
	$password = $_POST['password'];
	$email	  = $_POST['email'];
	$mobile	  = $_POST['mobile'];

	$error;

	if (empty($fullName)) {
		$error = "Full name is required";
	}elseif (empty($userName)) {
		$error = "Username is required";
	}elseif (empty($password)) {
		$error = "Password is required";
	}elseif (empty($email)) {
		$error = "Email is required";
	}elseif (empty($mobile)) {
		$error = "Mobile is required";
	} else {

		$alreadyExistValue =mysqli_query($dbcon,"SELECT * FROM `users` WHERE `user_name` = $userName");

		if (mysqli_num_rows($alreadyExistValue) == 0) {

		$insertQuery = "INSERT INTO `users` (`user_id`, `full_name`, `user_name`, `password`, `email`, `mobile`) 
		VALUES (NULL, '$fullName', '$userName', '$password', '$email', '$mobile')";

		$query = mysqli_query($dbcon, $insertQuery);

			if (query) {

				$userId = mysqli_insert_id($dbcon);
				$response['status'] = true;
				$response['message'] = "Register Sucessfully";
				$response['userId'] = $userId;
			} else {
				$response['status'] = false;
				$response['message'] = "Register Failed";
			}
		} else {
			$response['status'] = false;
			$response['message'] = "already Username exist. please do login";
		}
}

echo json_encode($response);
?>
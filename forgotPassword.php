<?php
	session_start();

    define('DOCROOT', realpath(dirname(__FILE__)) . '/');	
	require(DOCROOT . 'activationAndNotifications.php');

	$conn = mysqli_connect("localhost","root","password","chat");

	$email = $_POST['email'];

	$activation = rand(1000000000,9999999999);
	
	$_SESSION['email'] = $email;

	$stm = "update users set activationCode = ".$activation." where email='".$email."';";
	
	mysqli_query($conn, $stm);
	
	$stm = "update users set pwcr = 1 where email = '".$email."';";
	
	if(mysqli_query($conn, $stm) == true)
	{
		$not = new notification();
		$link = "http://32.208.103.211/chatRegistration/passwordChange.php?activationCode=".$activation."&email=".$email;
		$body = "We recieved a request to reset the password and following is the link to reset it. <br><br><a href='".$link."'>Click here</a> to reset your password.";
		$not->email("mailtosecureyou@gmail.com","Administration","mailtosecureyou@gmail.com","mailstodeliver",$email,"Password Change Request",$body);
		$_SESSION['newlyRegistered'] = $uname;
		$_SESSION['homeMessage'] = "Email has been sent with all necessary instructions to reset your password.";
		echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";
	}
	else
	{
		$_SESSION['error'] = 1;
		echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/forgotpassword1.php'>";
	}

	mysqli_close($conn);
?>
<?php
	session_start();
	/*define('DOCROOT' realpath(dirname(__FILE__)) . '/');
	require (DOCROOT . 'dbConn.php');
	$con = new dbConn();*/
	
	$conn = mysqli_connect("localhost","root","password","chat");	

	$email = $_POST['email'];
	
	$stm = "select email from users where email = '".$email."' and activated = 1;";
	
	$res = mysqli_query($conn,$stm);
	
	if(mysqli_num_rows($res) > 0)
	{
		$file = $_POST['worked'];
		if($file == 'Android Version')
		{
			$file = 'Babbleon.apk';
		}
		else if($file == 'Desktop Version')
		{
			$file = 'Babbleon.jar';
		}
		
		header('Content-type: application/java-archive');
		header("Cache-control: private");
		header('Content-disposition: attachment; filename="'.$file.'"');
		readfile('files/'.$file);
	}
	else
	{
		$_SESSION['homeMessage'] = "Email does not exists or is not activated";
		echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";
	}
	mysqli_close($conn);
?>
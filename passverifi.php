<?php
	session_start();
	define('DOCROOT', realpath(dirname(__FILE__)) . '/');
	require (DOCROOT . 'dbConn.php');
	
    $conn = mysqli_connect("localhost","root","password","chat");
	
	$password = $_POST['password'];
	$email = $_SESSION['email'];
    
	require(DOCROOT . 'activationAndNotifications.php');
	$stm = "select pwcr from users where email = '".$email."';";
	$res = mysqli_query($conn,$stm);
	echo "101";
	if (mysqli_num_rows($res) > 0) {
    	while($row = mysqli_fetch_assoc($res)) 
	   {
	       if($row['pwcr'] == 1)
	       {
		      $stm = "update users set password = '".$password."' where email='".$email."';";
	
		      if(mysqli_query($conn,$stm) == true)
		      {
                  $not = new notification();
			      $body = "Password changed successfully.";
			      $not->email("mailtosecureyou@gmail.com","Administration","mailtosecureyou@gmail.com","mailstodeliver",$email,"Password Changed Successfully",$body);
			      $stm = "update users set pcwr = 0 where email = '".$email."';";
			      mysqli_query($conn,$stm);
			      $stm = "update users set activationCode = 0 where email = '".$email."';";
			      mysqli_query($conn,$stm);
			      $_SESSION['homeMessage'] = "Password has been changed successfully.";
			      echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";
		      }
		      else
		      {
			     $_SESSION['homeMessage'] = "Link has been expired.";
			     echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";
		      }
	       }
	   }
	}
	mysqli_close($conn);
?>
<?php
    session_start();
    define('DOCROOT', realpath(dirname(__FILE__)) . '/');
	require(DOCROOT . 'activationAndNotifications.php');
    $activation = rand(1000000000,9999999999);

    $conn = mysqli_connect("localhost","root","password","chat");
    $choice = $_POST['email'];
    
    $stm = "select * from users where email='".$choice."' and activated = 0;";
    
    $res = mysqli_query($conn, $stm);

    if(mysqli_num_rows($res) > 0)
    {
        $not = new notification();
            $link = "http://32.208.103.211/chatRegistration/activateAccount.php?activationCode=".$activation."&email=".$choice;
            $stm = "update users set activationCode=".$activation." where email = '".$choice."';";
            mysqli_query($conn,$stm);
			$body = "Thank you for registering with us.<br><br><a href='".$link."'>Click here</a> to activate your account.";
            $ans = $not->email("mailtosecureyou@gmail.com","Administration","mailtosecureyou@gmail.com","mailstodeliver",$choice,"Activation Link",$body);
        
        
        $_SESSION['homeMessage'] = "Activation link has been sent to your email, use that to activate your account.";
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";
    }
    else
    {
        $_SESSION['bod'] = 2;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/activationLink1.php'>";
    }
?>
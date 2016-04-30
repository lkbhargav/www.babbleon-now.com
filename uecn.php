<?php
    session_start();
    define('DOCROOT', realpath(dirname(__FILE__)) . '/');
    
	require(DOCROOT . 'activationAndNotifications.php');
    $conn = mysqli_connect("localhost","root","password","chat");
    $activation = rand(1000000000,9999999999);

    $usn = $_SESSION['username'];
    $cn = $_POST['number'];
    $eid = $_POST['email'];
    $cc = $_POST['country'];

    $cc = ($cc == "INDIA")? 91 : ($cc == "USA")? 1 : 61;
    $s = $cn."";
    $l = strlen($s);

    if($l != 10)
    {
        $_SESSION['err1'] = 10;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
    }

    if($_POST['butto'] == 'Change Email ID')
    {
        $stm = "select email from users where email='".$eid."';";
        $res = mysqli_query($conn,$stm);
        if(mysqli_num_rows($res) > 0)
        {
            $_SESSION['err1'] = 5;
            echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
        }
        else
        {
        //echo "<script>alert('".$usn." and ".$eid."');</script>";
        $stm = "update users set email = '".$eid."' where username = '".$usn."'; ";
        mysqli_query($conn,$stm);
        $stm = "update users set activationCode = ".$activation." where username = '".$usn."';";
        mysqli_query($conn,$stm);
        $not = new notification();
        $link = "http://32.208.103.211/chatRegistration/activateAccount.php?activationCode=".$activation."&email=".$eid;
        $body = "Since you changed your Email ID, you have to re verify by using the activation link provided below.<br><br><a href='".$link."'>Click here</a> to activate your account.";
        $not->email("mailtosecureyou@gmail.com","Administration","mailtosecureyou@gmail.com","mailstodeliver",$eid,"Activation Email",$body);
        $stm = "update users set activated = 0 where username = '".$usn."';";
        mysqli_query($conn,$stm);
        echo "<script>alert('Email Changed Successfully, check your inbox/text messages to reactivate your account.');</script>";
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/logout.php'>";
        }
    }
    else if($_POST['butto'] == 'Change Contact Number')
    {
        $cn = $cc.$cn;
        $stm = "update users set contactNumber = ".$cn." where username = '".$usn."'; ";
        mysqli_query($conn,$stm);
        $stm = "update users set activationCode = ".$activation." where username = '".$usn."';";
        mysqli_query($conn,$stm);
        $not = new notification();
        $link = "http://32.208.103.211/chatRegistration/activateAccount.php?activationCode=".$activation."&email=".$eid;
        $body = "Use the link below to re-activate your account.".$link.".";
        $not->message("12035432147",$cn,$body);
        $stm = "update users set activated = 0 where username = '".$usn."';";
        mysqli_query($conn,$stm);
        echo "<script>alert('Contact Number Changed Successfully, check your inbox/text messages to reactivate your account.');</script>";
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/logout.php'>";
    }
?>
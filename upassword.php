<?php
    session_start();
    $conn = mysqli_connect("localhost","root","password","chat");
    define('DOCROOT', realpath(dirname(__FILE__)) . '/');
    //echo "<script>alert('1.');</script>";
	require(DOCROOT . 'activationAndNotifications.php');
    $old = $_POST['old'];
    $pass = $_POST['password'];
    $usn = $_SESSION['username'];
    if(strcmp($old, $pass) !== 0)
    {
        $_SESSION['err1'] = 20;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
    }
    $stm = "select password from users where username='".$usn."';";
    $res = mysqli_query($conn,$stm);
    if(mysqli_num_rows($res) > 0)
    {
        //echo "<script>alert('2.');</script>";
        $row = mysqli_fetch_assoc($res);
        if($old == $row['password'])
        {
            //echo "<script>alert('3.');</script>";
            $stm = "update users set password='".$pass."' where username='".$usn."';";
            mysqli_query($conn,$stm);
            $stm = "select email from users where username='".$usn."';";
            $res = mysqli_query($conn,$stm);

            if($row = mysqli_fetch_assoc($res))
            {
                $not = new notification();
                $body = "Password has been changed successfully.";
                $not->email("mailtosecureyou@gmail.com","Administration","mailtosecureyou@gmail.com","mailstodeliver",$row['email'],"Password Change",$body);
                echo "<script>alert('Password Changed Successfully.');</script>";
            }
            echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/logout.php'>";
        }
        else
        {
            $_SESSION['err1'] = 15;
            echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
        }
    }
?>
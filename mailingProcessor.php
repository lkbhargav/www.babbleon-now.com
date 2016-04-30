<?php
    session_start();
    define('DOCROOT', realpath(dirname(__FILE__)) . '/');
	require(DOCROOT . 'activationAndNotifications.php');

    $conn = mysqli_connect("localhost","root","password","chat");
    $choice = $_POST['users'];
    if($choice == 'act')
    {
        $stm = "select email from users where activated = 1";    
    }
    else if($choice == 'notact')
    {
        $stm = "select email from users where activated = 0";
    }
    else
    {
        $stm = "select email from users";
    }

    $sub = $_POST['subject'];
    $bod = $_POST['body'];
    
    $res = mysqli_query($conn, $stm);

    if(mysqli_num_rows($res) > 0)
    {
        $not = new notification();
        while($row = mysqli_fetch_assoc($res))
        {
            $ans = $not->email("mailtosecureyou@gmail.com","Administration","mailtosecureyou@gmail.com","mailstodeliver",$row['email'],$sub,$bod);
        }
        $_SESSION['bod'] = 1;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/mailingLists.php'>";
    }
    else
    {
        $_SESSION['bod'] = 2;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/mailingLists.php'>";
    }
?>
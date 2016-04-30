<?php
   
    session_start();
    $conn = mysqli_connect("localhost","root","password","chat");
    define('DOCROOT', realpath(dirname(__FILE__)) . '/');

	require(DOCROOT . 'activationAndNotifications.php');
    
    if(isset($_POST['Accept']))
    {
        $val = $_POST['Accept'];
        $activation = rand(1000000000,9999999999);
        $val = substr($val,6);
        $val = intval($val);
        $stm = "select email from sourcecodereq where id = ".$val.";";
        $res = mysqli_query($conn,$stm);
        if(mysqli_num_rows($res) > 0)
        {
            $row = mysqli_fetch_assoc($res);
            $link = "http://32.208.103.211/chatRegistration/downloadSourceCode.php?code=".$activation;
            $body = "Your request is accepted for Source code download. Your download link is here " . $link;
            $not = new notification();
            $not->email("mailtosecureyou@gmail.com","Babble On","mailtosecureyou@gmail.com","mailstodeliver",$row['email'],"Source Code Download",$body);
            $stm = "insert into downloadVeri  values(".$activation.");";
            mysqli_query($conn,$stm);
            $stm = "update sourcecodereq set accepted = 1  where id = ".$val.";";
            mysqli_query($conn,$stm);
            $stm = "update sourcecodereq set denied = 0  where id = ".$val.";";
            mysqli_query($conn,$stm);
        }
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/downloadRequestsProcessor.php'>";
    }
    else if(isset($_POST['Denial']))
    {
        $val = $_POST['Denial'];
        $val = substr($val,4);
        $val = intval($val);
        $stm = "update sourcecodereq set accepted = 0 where id = ".$val.";";
        mysqli_query($conn,$stm);
        $stm = "update sourcecodereq set denied = 1  where id = ".$val.";";
        mysqli_query($conn,$stm);
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/downloadRequestsProcessor.php'>";
    }
    else
    {
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/downloadRequestsProcessor.php'>";
    }
?>
<?php
    session_start();
    $id = $_SESSION['uerid'];
    
    define('DOCROOT', realpath(dirname(__FILE__)) . '/');

	require(DOCROOT . 'activationAndNotifications.php');
    
    $conn = mysqli_connect("localhost","root","password","chat");
    
    $stm = "select email from contactus where id = ". $id .";";
    
    $res = mysqli_query($conn,$stm);

    if(mysqli_num_rows($res) > 0)
    {
        $row = mysqli_fetch_assoc($res);
        
        $not = new notification();
        $body = "Thank you for contacting us.<br><br>".$_POST['replyText']."<br> <br> From <br> ADMIN";
        $ans = $not->email("mailtosecureyou@gmail.com","Administration","mailtosecureyou@gmail.com","mailstodeliver",$row['email'],"Reply (Contact Us)",$body);
        $stm = "update contactus set replied = 1 where id = ".$id.";";
        mysqli_query($conn,$stm);
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/contactUsProcessing.php'>";
    }
?>
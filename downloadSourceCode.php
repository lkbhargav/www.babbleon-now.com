<?php
    session_start();
    $conn = mysqli_connect("localhost","root","password","chat");
    $code = intval($_GET['code']);
    $stm = "select code from downloadVeri where code = ".$code.";";
    $res = mysqli_query($conn,$stm);
    if(mysqli_num_rows($res) > 0)
    {
    $row = mysqli_fetch_assoc($res);
    if($code == $row['code'])
    {
        $stm = "update downloadVeri set code = 1 where code = ".$code.";";
        mysqli_query($conn,$stm);
        $file = 'SourceCode.zip';
		header('Content-type: Application/zip');
		header("Cache-control: private");
		header('Content-disposition: attachment; filename="'.$file.'"');
		readfile('files/'.$file);
        $_SESSION['homeMessage'] = "Successfully Downloaded Source Code";
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";
    }
    else
    {
	//echo "<script> alert('1st'); </script>";
        $_SESSION['homeMessage'] = "Link has been expired or Invalid";
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";
    }
    }
    else
    {
	//echo "<script> alert('2nd'); </script>";
        $_SESSION['homeMessage'] = "Link has been expired or Invalid";
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";
    }
?>
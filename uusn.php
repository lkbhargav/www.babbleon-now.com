<?php
    session_start();
    $conn = mysqli_connect("localhost","root","password","chat");
    $usn = $_SESSION['username'];

    $nusn = $_POST['usn'];
    //echo "<script> alert('".$nusn."'); </script>";
    $nnusn = $nusn;
    $stm = "select username from users where username = '".$nusn."';";

    $res = mysqli_query($conn,$stm);

    if(mysqli_num_rows($res) > 0)
    {
        $_SESSION['err1'] = 1;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
    }
    else
    {
        $stm = "select imgName from users where username='".$usn."';";
        $res = mysqli_query($conn,$stm);
        if(mysqli_num_rows($res) > 0)
        {
            $row = mysqli_fetch_assoc($res);
            $exn = $row['imgName'];
            $l = strlen($exn);
            $exln = "uploads/".$exn;
            $l -= 4;
            $exn2 = $exn;
            $ext = substr($exn,-4);
            
            if($ext == '.jpe')
            {
                $ext = substr($exn2,-5);    
            }
            
            $nusn = $nusn.$ext;
            //echo "<script> alert('".$nusn."'); </script>";
            $stm = "update users set imgName='".$nusn."' where username='".$usn."';";
            mysqli_query($conn,$stm);
            $nusn = "uploads/".$nusn;
            rename($exln,$nusn);
        }
        $stm = "update users set username='".$nnusn."' where username='".$usn."';";
        mysqli_query($conn,$stm);
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/logout.php'>";
    }
?>
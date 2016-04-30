<?php
    session_start();
    $conn = mysqli_connect("localhost","root","password","chat");
    
    if(isset($_SESSION['tempname']))
    {
        //echo "<script>alert('here');</script>";
        $tar_file = $_SESSION['tempname'];
        
        $stm = "update users set imgName=NULL where username = '".$_SESSION['newlyRegistered']."';";
        
        mysqli_query($conn,$stm);
        if(file_exists($tar_file))
	    {
		  unlink($tar_file);
          //echo "<script>alert('deleted');</script>";
	    }
    }

    echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/finalRegistrationSuccess.php'>";
?>
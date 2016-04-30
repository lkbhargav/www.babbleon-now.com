<?php
session_start();

$conn = mysqli_connect("localhost","root","password","chat");
$newFileName = $_SESSION['username'];
if($_POST['submit'] == 'Use this Image')
{
	
	define('DOCROOT', realpath(dirname(__FILE__)) . '/');
	$tar_d = DOCROOT . "uploads/";
	
	$tar_file = $tar_d .basename($_FILES["fileToUpload"]["name"]);

	$imgType = pathinfo($tar_file, PATHINFO_EXTENSION);

	if($imgType == "jpg")
	{
		$newFileName = $newFileName . ".jpg";
	}
	else if($imgType == "gif")
	{
		$newFileName = $newFileName . ".gif";
	}
	else if($imgType == "jpeg")
	{
		$newFileName = $newFileName . ".jpeg";
	}
	else if($imgType == "png")
	{
		$newFileName = $newFileName . ".png";
	}
	else
	{
		$uOK = 0;
		$_SESSION['error4'] = 1;
		echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
	}
	
	$_FILES['fileToUpload']['name'] = $newFileName;
	
	$tar_file = "uploads/" .basename($_FILES['fileToUpload']['name']);
	
	$uOK = 1;
	
	if(isset($_POST["submit"]))
	{
		$chk = getimagesize($_FILES['fileToUpload']['tmp_name']);
		
		if($chk !== false)
		{
			$uOK = 1;
		}
		else
		{
			$_SESSION['error4'] = 3;
			$uOK = 0;
			echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
		}
	}

    $_SESSION['tempname'] = $tar_file;
	
    if(file_exists($tar_file))
	{
		unlink($tar_file);
	}

	if($_FILES["fileToUpload"]["size"] > 500000)
	{
		$_SESSION['error4'] = 2;
		$uOK = 0;
		echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
	}
	
	if($uOK == 1)
	{
		if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $tar_file))
		{
			$_SESSION['error4'] = 0;
			$_SESSION['image'] = $tar_file;
			
			$stm = "update users set imgName = '".$newFileName."' where username = '".$_SESSION['username']."';";
			mysqli_query($conn, $stm);
			mysqli_close($conn);
			echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
		}
		else
		{
			$_SESSION['error4'] = 3;
			echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
		}
	}
}
else if($_POST['submit'] == 'Remove Image')
{
    $stm = "select imgName from users where username = '".$newFileName."';";
    $res = mysqli_query($conn,$stm);
    if(mysqli_num_rows($res) > 0)
    {
        $row = mysqli_fetch_assoc($res);
        
        $file = "uploads/".$row['imgName'];
        
        unlink($file);
        
        $stm = "update users set imgName=NULL where username = '".$newFileName."';";
        
        mysqli_query($conn,$stm);
        
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/updateProfile.php'>";
    }
}
?>

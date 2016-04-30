<?php 
	session_start();
	define('DOCROOT', realpath(dirname(__FILE__)) . '/');

	require(DOCROOT . 'activationAndNotifications.php');
	$conn = mysqli_connect("localhost","root","password","chat");

	$stm = "select * from contactus order by replied;";
	$res = mysqli_query($conn,$stm);

	if(mysqli_num_rows($res) > 0)
	{
        $t = "<tr>";
        $t .= "<th> ID </th>";
        $t .= "<th> Name </th>";
        $t .= "<th> Email </th>";
        $t .= "<th> Contact Number </th>";
        $t .= "<th> Subject </th>";
        $t .= "<th> Description </th>";
        $t .= "<th> Reply </th>";
        $t .= "</tr>";
		while($row = mysqli_fetch_assoc($res))
        {
            $t .= "<tr>";
            $t .= "<td> ".$row['id']."</td>";
            $t .= "<td> ".$row['name']."</td>";
            $t .= "<td> ".$row['email']."</td>";
            $t .= "<td> ".$row['contactNumber']."</td>";
            $t .= "<td> ".$row['subject']."</td>";
            $t .= "<td> ".$row['description']."</td>";
            if($row['replied'] == 1)
            {
                $t .= "<td> Replied </td>";
            }
            else
            {
                $t .= "<td> <input type='submit' name='reply' class='btn btn-success' value='Reply".$row['id']."'> </td>";
            }
            $t .= "</tr>";
        }
        
        $_SESSION['downsource'] = $t;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/contactUsFront.php'>";
	}
	else
	{
        $t = "<h3>No data to display.</h3>";
        $_SESSION['nodata'] = $t;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/contactUsFront.php'>";
	}
	
    mysqli_close($conn);
?>

<?php 
	session_start();
	define('DOCROOT', realpath(dirname(__FILE__)) . '/');

	require(DOCROOT . 'activationAndNotifications.php');
	$conn = mysqli_connect("localhost","root","password","chat");

	$stm = "select * from sourcecodereq order by accepted, denied;";
	$res = mysqli_query($conn,$stm);

	if(mysqli_num_rows($res) > 0)
	{
        $t = "<tr>";
        $t .= "<th> ID </th>";
        $t .= "<th> Name </th>";
        $t .= "<th> Email </th>";
        $t .= "<th> Contact Number </th>";
        $t .= "<th> Profession </th>";
        $t .= "<th> Reason </th>";
        $t .= "<th> Accept </th>";
        $t .= "<th> Deny </th>";
        $t .= "</tr>";
		while($row = mysqli_fetch_assoc($res))
        {
            $t .= "<tr>";
            $t .= "<td> ".$row['id']."</td>";
            $t .= "<td> ".$row['name']."</td>";
            $t .= "<td> ".$row['email']."</td>";
            $t .= "<td> ".$row['contactNumber']."</td>";
            $t .= "<td> ".$row['profession']."</td>";
            $t .= "<td> ".$row['reason']."</td>";
            if($row['accepted'] == 1)
            {
                $t .= "<td colspan='2'> Accepted </td>";
            }
            else if($row['denied'] == 1)
            {
                $t .= "<td colspan='2'> Denied </td>";
            }
            else
            {
                $t .= "<td> <input type='submit' name='Accept' class='btn btn-success' value='Accept".$row['id']."'> </td>";
                $t .= "<td> <input type='submit' name='Denial' class='btn btn-danger' value='Deny".$row['id']."'> </td>";
            }
            $t .= "</tr>";
        }
        
        $_SESSION['downsource'] = $t;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/downloadRequestsFront.php'>";
	}
	else
	{
        $t = "<h3>No data to display.</h3>";
        $_SESSION['nodata'] = $t;
        echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/downloadRequestsFront.php'>";
	}
	
    mysqli_close($conn);
?>

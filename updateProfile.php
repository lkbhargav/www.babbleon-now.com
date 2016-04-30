<html>
	<head>  <?php session_start(); 
            
            if(!isset($_SESSION['username']))
            {
                echo "<meta http-equiv='refresh' content='0; url=http://32.208.103.211/chatRegistration/index.php'>";    
            }
        ?>
		<title> Babble On.. </title>
		<link rel="shortcut icon" href="img/simpleChatIcon.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/myNewStyles.css">
        <script src="js/val2.js"></script>
        <script src="js/val1.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<script src="js/val.js"></script>
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/bootstrap-social.css" rel="stylesheet">
	</head>
	
	
	
	<body>
		<div class="navbar-wrapper">
		<div class="container">
		<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand"><span><img src="img/simpleChatIcon.png" height="30" width="50" /></span></a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapsenavbar">
					<span class="glyphicon glyphicon-menu-hamburger simpletext"> </span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse" id="collapsenavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span class="glyphicon glyphicon-home"> </span> Home</a><li>
					<li><a href="downloadPage.php"><span class="glyphicon glyphicon-download"> </span> Download</a></li>
					<li><a href="registerHere.php"><span class="glyphicon glyphicon-user"> </span> Sign Up</a></li>
					<li><a href="contactUs.php"><span class="glyphicon glyphicon-phone"> </span> Contact</a></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
				<?php 
					//echo "<h1>Sai Baba</h1>";
					//session_start();
					if(isset($_SESSION['username']) || isset($_SESSION['adminname']))
					{
						if(isset($_SESSION['username']))
						{
							$name = $_SESSION['username'];
						}
						
						if(isset($_SESSION['adminname']))
						{
							$aname = $_SESSION['adminname'];
						}
						
						if($_SESSION['code'] == 1)
						{  ?>
						
						<li class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-unlock"> </span> Welcome, <?php echo $name; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="dashboardFront.php"> Dashboard </a></li>
							
							<li><a href="updateProfile.php"> Update Profile </a></li>
							<li class="divider"> </li>
							<li><a href="logout.php"> Logout </a></li>
						</ul>
					</li>
				
				<?php	
						//echo "<script> alert('All sessions will be removed'); </script>";
						}
						else if($_SESSION['code'] == 2)
						{ //echo "<script> alert('All sessions will be removed123'); </script>";?>
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-lock"> </span> Welcome Admin, <?php echo $aname; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
                            <li><a href="mailingLists.php"> Mailing Lists </a></li>
							<li><a href="contactUsProcessing.php"> Contact Requests </a></li>
							<li><a href="downloadRequestsProcessor.php"> Download Requests </a></li>
							<li class="divider"> </li>
							<li><a href="logout.php"> Logout </a></li>
						</ul>
					</li>
				<?php		
						}
					}else { ?>
					
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"> </span> Login <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#adminLogin" data-toggle="modal"> Admin Login </a></li>
							<li class="divider"> </li>
							<li><a href="#userLogin" data-toggle="modal"> User Login </a></li>
						</ul>
					</li>
				<?php				
					}
				?>
				</ul>
			</div>
		</div>
		</nav>
		</div>
		</div>
		
		<div class="modal fade" id="adminLogin" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"> &times; </button>
						<h3 class="modal-title" align="center">Admin Login</h3>
					</div>
					
					<div class="modal-body">
						<form role="form" method="post" action="adminLoginProcess.php">
							<div class="form-group">
								<label for="username"> User Name: </label>
								<input type="text" name="adminusername" class="form-control" placeholder="Username" required/>
							</div>
							
							<div class="form-group">
								<label for="password"> Password: </label>
								<input type="password" name="adminpassword" placeholder="Password" class="form-control" required/>
							</div>
							
							
							&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							<input type="submit" class="btn btn-info" value="Login"/>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="modal fade" id="userLogin" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"> &times; </button>
						<h3 class="modal-title" align="center">User Login</h3>
					</div>
					
					<div class="modal-body">
						<form role="form" method="post" action="userLoginProcessor.php">
							<div class="form-group">
								<label for="username" > User Name: </label>
								<input type="text" name="userusername" class="form-control" placeholder="Username" required/>
							</div>
							
							<div class="form-group">
								<label for="password" > Password: </label>
								<input type="password" name="userpassword" placeholder="Password" class="form-control" required/>
							</div>
							
							<a href="forgotpassword1.php"> Forgot Password </a> <br> 
                            <a href="activationLink1.php"> Resend Activation Link </a> <br>
							<a href="forgotusername1.php"> Forgot Username </a> <br> <br>
							&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							<input type="submit" class="btn btn-info" value="Login"/>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="js/val1.js"> </script>
		<div class="jumbotron">
			<div class = "container">
				<div class="row row-content">
				<br>
					<h2 style="text-align:center;"> Update Profile </h2>
				</div>
			</div>
		</div>
		
		<?php
			$email = $_GET['email'];
			$code = intval($_GET['activationCode']);
			
			$conn = new mysqli("localhost:3316","root","lkbhargav123KING#@!$%","chat");
	
			$stm = "select activationCode, name from users where email='".$email."';";
			
			$result = $conn->query($stm);

			if ($result->num_rows > 0) 
			{
				$r = $result->fetch_assoc();

				if($r['activationCode'] == $code)
				{
					$name = $r['name'];
					echo "<h3 style='text-align:center'> Hi ".$name.", update your password as shown below. </h3> <br> <br>";
				}
				else
				{
					$_SESSION['homeMessage'] = "Link has expired or invalid, try again";
					echo "<meta http-equiv='refresh' content='0; url=http://localhost/chatRegistration/index.php'>";
				}
			}
		?>
		
		<div class="container">
			<div class="row row-content">
				<div class="col-xs-12 col-sm-3 col-sm-offset-2">
                    <center> <h2> Change Password </h2> </center>
					<form role="form" onsubmit="return veri()" name="rf" method="post" action="upassword.php">
                        <div class="form-group">
                            <label> Enter Old Password: </label>
                            <input type="password" name="old" placeholder="Ex: Passw0rd!" class="form-control" required/>
                        </div>
                        
                        <div class="form-group">
                            <label> Enter New Password: </label>
                            <input type="password" name="password" placeholder="Ex: Passw0rd!" class="form-control" required/>
                        </div>
                        
                        <div class="form-group">
                            <label> Re-Enter New Password: </label>
                            <input type="password" name="verpassword" class="form-control" required/>
                        </div>
                        <br>
                        <center><input type="submit" value="Change Password" placeholder="Ex: Passw0rd!" class="btn btn-info"/></center>
                    </form>
                    <center><p id="cpwerror" class="error"> </p></center>
                    <center><p id="pwerror" class="error"> </p></center>
				</div>
                
                <div class="col-xs-12 col-sm-3 col-sm-offset-2">
                    <center> <h2> Change Username </h2> </center>
                    <form role="form" method="post" action="uusn.php">
                        <div class="form-group">
                            <label> New Username: </label>
                            <input type="text" name="usn" placeholder="Ex: david25" class="form-control" required/>
                        </div>
                        <br>
                        <center><input type="submit" value="Change Username" class="btn btn-info"></center>
                    </form>
                    <center><p id="error1" class="error"> </p></center>
                </div>
            </div> <br> <br>
            <div class="row row-content">
                <div class="col-xs-12 col-sm-3 col-sm-offset-2">
                    <center> <h2> Change Email or Contact Number </h2> </center>
                    <form role="form" onsubmit="return numver()" name="rff" method="post" action="uecn.php">
                        <div class="form-group">
                            <label> New Email ID: </label>
                            <center><p id="error2" class="error"> </p></center>
                            <input type="email" name="email" placeholder="Ex: david25@gmail.com" class="form-control"/> <br>
                            <div class="alert alert-info" role="alert"> <b> Info: </b> Once you submit, you will get an activation email and you will be logged out automatically. </div>
                        </div>
                        <br>
                        <center><input type="submit" name="butto" value="Change Email ID" class="btn btn-info"></center>
                        <br>
                        <div class="form-group">
                            <label> New Contact Number: </label>
                            <center><p id="error3" class="error"> </p></center>
                            <div class="input-group">
						    <span class="input-group-addon"> 
				                <select name="country" id="country">
                                    <option value="USA"> USA (+1) </option>
								    <option value="INDIA"> India (+91) </option>
								    <option value="Austrailia"> Austrailia (+61) </option>
							    </select>
						    </span>
                            <input type="number" name="number" class="form-control"/>
                            </div> <br>
                            <div class="alert alert-info" role="alert"> <b> Info: </b> Once you submit, you will get an activation link text message and you will be logged out automatically. </div>
                        </div>
                        <br>
                        <center><input type="submit" name="butto" value="Change Contact Number" class="btn btn-info"></center>
                    </form>
                </div>
                
                <div class="col-xs-12 col-sm-3 col-sm-offset-2">
                    <?php
                        $conn = mysqli_connect("localhost","root","password","chat");
                        
                        $stm = "select imgName from users where username='".$_SESSION['username']."';";
                        $res = mysqli_query($conn,$stm);
                        if(mysqli_num_rows($res) > 0)
                        {
                            $row = mysqli_fetch_assoc($res);
                            
                            if($row['imgName'] == NULL)
                            {
                                echo "<img src='img/defaultprofile.png' id='image' width='300' height='300' />";    
                            }
                            else
                            {
                                echo "<img src='uploads/".$row['imgName']."' id='image' width='300' height='300' />";
                            }
                        }
                        else
                        {
                            echo "<img src='img/defaultprofile.png' id='image' width='300' height='300' />";
                        }
                    ?> <br>
                    <form role="form" method="post" action="uImageUploadBackend.php" enctype="multipart/form-data">
                        <input type="file" class="form-control-file" action="imageUploadBackend.php" name="fileToUpload" id="fileToUpload">
					    <br>
                        <center><input type="submit" value="Use this Image" name="submit" class="btn btn-info"></center> <br>
                        <center><input type="submit" value="Remove Image" name="submit" class="btn btn-danger"></center>
                        <p id="error4" class="error">  </p>
                    </form>
                </div>
			</div>
		</div>
		
		<?php
            if(isset($_SESSION['err1']))
            {
                if($_SESSION['err1'] == 1)
                {
                    echo "<script> document.getElementById('error1').innerHTML = 'Sorry username already exists.'; </script>";
                }
                else if($_SESSION['err1'] == 5)
                {
                    echo "<script> document.getElementById('error2').innerHTML = 'Email already exists.'; </script>";
                }
                else if($_SESSION['err1'] == 10)
                {
                    echo "<script> document.getElementById('error3').innerHTML = 'Enter a valid contact number.'; </script>";
                }
                else if($_SESSION['err1'] == 15)
                {
                    echo "<script> document.getElementById('cpwerror').innerHTML = 'Incorrect old password.'; </script>";
                }
                else if($_SESSION['err1'] == 20)
                {
                    echo "<script> document.getElementById('cpwerror').innerHTML = 'New password matches old password.'; </script>";
                }
                    
            }
        
            if(isset($_SESSION['error4']))
            {
                if($_SESSION['error4'] == 1)
                {
                    echo "<script> document.getElementById('error4').innerHTML = 'Images with .jpg, .png. jpeg and .gif extensions are accepted.'; </script>";
                }
                else if($_SESSION['error4'] == 3)
                {
                    echo "<script> document.getElementById('error4').innerHTML = 'Uploaded file is not an image.'; </script>";
                }
                else if($_SESSION['error4'] == 2)
                {
                    echo "<script> document.getElementById('error4').innerHTML = 'Image file size exceeds 500 KB.'; </script>";
                }
                else if($_SESSION['error4'] == 0)
                {
                    echo "<script> document.getElementById('error4').innerHTML = 'Image updated successfully.'; </script>";
                    echo "<script> document.getElementById('error4').className = 'success'; </script>";
                }
                
            }
        
        unset($_SESSION['error4']);
        unset($_SESSION['err1']);
			include 'footer.html';
		?>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	</body>
</html>
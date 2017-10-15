<html>
<?php include_once 'dbConfig.php'; ?>
<?php include 'menu.php'; ?>
<link rel="stylesheet" type="text/css" href="css/regForm.css">
<?php
$databaseHost = "localhost";
$databaseUsername = "root";
$databasePassword = "";
$databaseName = "admission2018";
//Register
try
	{
	// PDO Style
	$conn = new PDO("mysql:host=$databaseHost;dbname=$databaseName;", $databaseUsername, $databasePassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$msg = " ";
	// User Registeration Page
	if (isset($_POST['addRegister']))
		{
		$fullname = $_POST['fullname'];
		$gender = $_POST['gender'];
		$bgroup = $_POST['bgroup'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$pnumber = $_POST['pnumber'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$dob=$_POST['dob'];
		$password2 = $_POST['password2'];
		if ($password == $password2)
			{
			$query = $conn->prepare( "SELECT `email` FROM `student_data` WHERE `email` = ?" );			
			$query->bindValue( 1, $email );
			$query->execute();
			if($query->rowCount() > 0 )
			{	
				$msg = "<p style='text-align:center; color:red;'>This Email ID is already registered. Try Login</p>";
				

			}
			else{
				$password = md5($password);
				// PDO Style Insert
				$sql = "INSERT INTO `student_data` VALUES 
					(NULL,'$fullname','$gender','$bgroup','$address','$city','$state','$zip','$pnumber','$email','$password',NOW(),'$dob',1)";
						if ($conn->query($sql))
						{
						$msg = "<p style='text-align:center; color:green;'>Registration Successful. You Can register now</p>";

						}
			  			else
						{
						$msg = "An Error Occured Contact SysAdmin";
						}
			}
			}
		}
	}

	catch(PDOException $e)
		{
			$msg =  "Connection failed: " . $e->getMessage();
		}
?>
<body>
	<div class="container">
		<h1 class="well">Registration Form</h1>
			<?php echo $msg;?>
		<div class="col-lg-12 well">
			<div class="row">
				<form action="register.php" method="post">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-12 form-group">
								<label>Fullname
								</label>
								<input type="text" name="fullname" placeholder="Enter Full Name Here.." class="form-control" required>
							</div>	
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Gender
								</label>
								<input list="gender" name="gender" class="form-control" placeholder="Select Gender" required>
								<datalist id="gender">
									<option value="Male">
									<option value="Female">
								</datalist>
							</div>
							<div class="col-sm-6 form-group">
								<label>Blood Group
								</label>
								<input type="text" name="bgroup" placeholder="Enter Bloodgroup..(B+VE or B-VE)" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea name="address" placeholder="Enter Address Here.." rows="3" class="form-control" required></textarea>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
                                <label>Date of Birth</label>
                                <input type="text" data-format="dd/MM/yyy" id="datepicker"  placeholder="dd-MM-yyyy"  name="dob" class="form-control"  required>
							</div>
							<div class="col-sm-3 form-group">
								<label>City
								</label>
								<input type="text" name="city" placeholder="Enter City Name Here.."class="form-control" required>
							</div>
							<div class="col-sm-3 form-group">
								<label>State
								</label>
								<input type="text" name="state" placeholder="Enter State Name Here.." class="form-control" required>
							</div>
							<div class="col-sm-3 form-group">
								<label>Zip
								</label>
								<input type="text"  name="zip" placeholder="Enter Zip Code Here.." class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label>Phone Number
							</label>
							<input type="text" name="pnumber" placeholder="Enter Phone Number Here.." class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email Address
							</label>
							<input type="email" name="email" placeholder="Enter Email Address Here.." class="form-control" required>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Password
								</label>
								<input name="password" type="password" placeholder="Enter Password.." class="form-control" required>
							</div>
							<div class="col-sm-6 form-group">
								<label>Confirm Password
								</label>
								<input type="password" name="password2" placeholder="Confirm Password.." class="form-control" required>
							</div>
						</div>
						<input class="btn btn-lg btn-info" type="submit" name="addRegister"  value="Submit">
					</div>

				</form>
			</div>
		</div>
	</div>
</body>
</html>
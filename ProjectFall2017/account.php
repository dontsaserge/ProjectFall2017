<?php
$page_title="Create Account";
include_once("header.inc.php");
//include_once("page-header.php");
include_once("jumbotron.php");

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			
			
					<div class="well">
					<?php
						if($_SERVER['REQUEST_METHOD']=='POST'){
							require("mysqli_connect.php");
							
							$error=array();
							
							
							//VALIDATE THE INPUTS
							//------------Validate the first name
							
							if(empty(mysqli_real_escape_string($dbc, input_test($_POST['fname'])))){
								$error[]="You did not provide your first name!";
							}else{
								$fname=mysqli_real_escape_string($dbc, input_test($_POST['fname']));
							}
							
							//Validate the last name
							
							if(empty(mysqli_real_escape_string($dbc, input_test($_POST['lname'])))){
								$error[]="You did not provide your last name!";
							}else{
								$lname=mysqli_real_escape_string($dbc, input_test($_POST['lname']));
							}
							
							//Validatge the email
							
							if(empty(mysqli_real_escape_string($dbc, input_test($_POST['email'])))){;
								$error[]="You did not provide your email address!";
							}else{
								$email=mysqli_real_escape_string($dbc, input_test($_POST['email']));
								//Check if the username exist already
								
								$q1="SELECT * FROM users WHERE email='$email'";
								$r1=mysqli_query($dbc, $q1);
								$row=mysqli_num_rows($r1);
								
								if($row>0){
									$error[]="There is an existing user with the same username";
								}
								
								
								
								
								//
							}
							
							//Validate the password
							
							if(empty(mysqli_real_escape_string($dbc, input_test($_POST['pass1']))) || empty(mysqli_real_escape_string($dbc, input_test($_POST['pass2']))))
							{
								$error[]="You did not create a password!";
								
							}elseif(mysqli_real_escape_string($dbc, input_test($_POST['pass1'])) !=mysqli_real_escape_string($dbc, input_test($_POST['pass2'])))
							{
								$error[]="You password does not match!";
								
							}else{
								$pass=mysqli_real_escape_string($dbc, input_test($_POST['pass1']));
								
								//hash the password
								
								$passhash=password_hash($pass, PASSWORD_DEFAULT);
							}
							
							if(empty($error)){
								
								//make the query to insert the data
								$sql="INSERT INTO users (fname, lname, email, password, registration_date, user_level) VALUES('$fname', '$lname', '$email', '$passhash',NOW(), 0)";
								
								
								//RUN THE SQL
								$result=mysqli_query($dbc, $sql);
								
								if($result){
									echo('<h3><strong>You have successfully create your account <a href="signin.php">Click here</a> to login</strong></h3>');
									echo('<hr class="my-4">');
								}else{
									echo("Error");
									echo('<hr class="my-4">');
								}
								
								
							
							}else{
								echo("<h3>ERROR!!</h3>");
								echo('<hr class="my-4">');
								
								
								foreach($error as $message){
									echo("<strong>--</strong><i>$message</i><br>\n");
								}
								
								echo('<hr class="my-4">');
								
								
									
								
								
								
								
							}
							
							
							
							
						}
						
						//function to test the input
						
						function input_test($data){
							$data=trim($data);
							$data=htmlspecialchars($data);
							$data=stripcslashes($data);
							
							return $data;
						
						}
						
						?>
				<form class="form-horizontal" method="POST" action="account.php">
				<div class="form-group">
						<label class="label-control col-md-2">First Name:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="fname">
						</div>
					</div>
					<div class="form-group">
						<label class="label-control col-md-2">Last Name:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="lname">
						</div>
					</div>
					<div class="form-group">
						<label class="label-control col-md-2">Email:</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email">
						</div>
					</div>
					<div class="form-group">
						<label class="label-control col-md-2">Password:</label>
						<div class="col-md-3">
							<input type="password" class="form-control" name="pass1">
						</div>
					</div>
					
					<div class="form-group">
						<label class="label-control col-md-2">Retype Password:</label>
						<div class="col-md-3">
							<input type="password" class="form-control" name="pass2">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="index.php" class="btn btn-defautl">Cancel</a>
							
						</div>
					</div>
					<hr class="my-4">
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<p><a href="signin.php">Or login into your account!!</a></p>
							
						</div>
					</div>
					
				</form>
			</div>
			</div>
			
		
		<div class="col-md-2"></div>
	</div>
</div>








<?php
include_once("footer.php");

?>
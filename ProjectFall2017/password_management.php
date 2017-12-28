<?php
$page_title="Change password";
include_once("header.inc.php");
include("jumbotron.php");

//if(!isset($_SESSION['user_level']) or isset($_SESSION['user_level'])!=0){
//	header("Location: signin.php");
//	exit();
//}

?>
<div class="row">
	
	<div class="col-md-2"></div>
	<div class="col-md-8">
			<div class="row">
				<div class="container-fluid">
					<div class="col-md-3"></div>
					<div class="col-md-9">
							<?php
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			require('mysqli_connect.php');
			
			$error=array();
			
			
			//VALIDATE THE EMAIL ADRESS
			
			if(empty(input_test($_POST['email'])))
			{
				$error[]='<span class="text-danger"><strong>you did not enter your email address<strong></span>';
			}else
			{
				$email=mysqli_real_escape_string($dbc, input_test($_POST['email']));
				
				//CHECK IF THE USER EXIST
				
				$sql1="SELECT * FROM users WHERE email='$email'";
				$result1=mysqli_query($dbc, $sql1);
				$row=mysqli_num_rows($result1);
				
				if($row==0)
				{
					$error[]='<span class="text-danger"><strong>Sorry invalide email<strong></span>';
				}else
				{
					if(empty($_POST['pass1']) || empty($_POST['pass2']))
					{
						$error[]='<span class="text-danger"><strong>Please provide the new passord<strong></span>';
						
					}elseif($_POST['pass1']!=$_POST['pass2'])
					{
						$error[]='<span class="text-danger"><strong>You password doesn\'t match<strong></span>';
					}else
					{
						$pass=mysqli_real_escape_string($dbc, input_test($_POST['pass1']));
						
						//hash the password
						$passHash=password_hash($pass, PASSWORD_DEFAULT);
						
						$sql="UPDATE users SET password='$passHash' WHERE email='$email'";
						$result=mysqli_query($dbc, $sql);
						
						if($result){
							echo("<strong><span class='text-success'>You have successfully reset your passord</span></strong>");
							echo('<hr class=my-4>');
						}
					}
				}
			}
			if(!empty($error))
			{
				echo("The following(s) error(s) occured!<br>");
					foreach($error as $message)
					{
						echo("--$message<br>\n");
					}
				echo('<hr class="my-4">');
				
			
		}
		}
		//function to validate the input
		
		function input_test($data)
		{
			$data=htmlspecialchars($data);
			$data=trim($data);
			$data=stripcslashes($data);
			
			return($data);
		}
		?>
		
					</div>
				</div>
			</div>
		<form action="password_management.php" method="POST" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-3">Email:</label>
				<div class="col-md-9">
					<input type="email"  name="email" class="form-control" >
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3">New Password:</label>
				<div class="col-md-5">
					<input type="password" class="form-control" name="pass1">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3">Retype Password:</label>
				<div class="col-md-5">
					<input type="password" name="pass2" class="form-control">
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
		
		
	</div>
	<div class="col-md-8"></div>
</div>









<?php
include_once("footer.php");

?>
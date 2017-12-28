<?php
$page_title="Edit user";
include_once("header.inc.php");
//include_once("page-header.php");
include_once("jumbotron.php");
//include_once("includes/jumbotDESCRIPTIONhp");

?>


<?php

if(isset($_GET['id'])){
	
	$user_id=$_GET['id'];
	
	include('mysqli_connect.php');
	
	$sql="SELECT * FROM users WHERE user_id='$user_id'";
	$run=mysqli_query($dbc, $sql);
	
	//$row=mysqli_fetch_array($run, MYSQLI_ASSOC);
	
	$num_row=mysqli_num_rows($run);
	
	
	while($row=mysqli_fetch_array($run, MYSQLI_ASSOC)){


?>
<div class="row">
	<div class="container">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			
			<form action="edit_user.php?id=<?php echo($row['user_id']); ?>" method="POST" class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-md-3">First Name:</label>
		<div class="col-md-9">
			<input type="text" name="fname" class="form-control" value="<?php echo($row['fname']); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3">Last Name:</label>
		<div class="col-md-9">
			<input type="text" name="lname" class="form-control" value="<?php echo($row['lname']);?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3">Email:</label>
		<div class="col-md-9">
			<input type="text" name="email" class="form-control" value="<?php echo($row['email']); ?>">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-offset-3 col-md-9">
			<button type="submit" class="btn btn-primary">Continue</button>
		</div>
	</div>
	
	
</form>
			
		</div>
		<div class="col-md-2"></div>
	</div>
</div>



<div class="row">
	<div class="container">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			

<?php

		
	}
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//require('mysqli_connect.php');
		$user_id=$_GET['id'];
		$error=array();
		//validate the input
		//validate the first name;
		
		if(empty($_POST['fname'])){
			$error[]="You did not provide the your first name";
			
		}else{
			$fname=mysqli_real_escape_string($dbc, input_test($_POST['fname']));
		}
		//validate the last name
		if(empty($_POST['lname'])){
			$error[]="You did not provide your last name";
		}else{
			$lname=mysqli_real_escape_string($dbc, input_test($_POST['lname']));
		}
		//validate the email
		
		if(empty($_POST['email'])){
			$error[]="You did not provide your email address";
		}else{
			$email=mysqli_real_escape_string($dbc, input_test($_POST['email']));
		}
		
		if(empty($error)){
			
			//make the query
			
			$sql="UPDATE users SET fname='$fname', lname='$lname', email='$email' WHERE user_id='$user_id'";
			//run the query
			$run=mysqli_query($dbc, $sql);
			
			if($run){
				echo('<span class="text-success"><h3>Succes! The changes was successffully saved</h3> <a href="view_user.php" class="btn btn-success">Click here to view the change</a></span>');
				echo('');
			}else{
					echo('<span class="text-danger"><h3>ERROR! The changes was not saved</h3></span>');	
			}
			
		}else{
			echo("The following(s) error(s) occured");
			foreach($error as $message){
				echo("-$message<br>\n");
			}
		}
		
		
	}
	

	

	
}else{
	echo("System error");
}

	function input_test($data)
	{
		$data=htmlspecialchars($data);
		$data=stripcslashes($data);
		$data=trim($data);
		
		return($data);
	}

?>

		</div>
		<div class="col-md-2"></div>
	</div>
</div>





<?php
include_once("footer.php");

?>
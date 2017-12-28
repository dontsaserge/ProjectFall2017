<?php
$page_title="Login";
include_once("header.inc.php");
//include_once("page-header.php");
include_once("jumbotron.php");
//include_once("includes/jumbotron.php");

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
		
		<?php
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				require('mysqli_connect.php');
				$errors=array();
				
				if(empty($_POST['email'])){
					$errors[]="You did not provide email address";
				}else{
					$email=mysqli_real_escape_string($dbc, input_test($_POST['email']));
				}
				if(empty($_POST['pass'])){
					$errors[]="Please provide the password linked to your username";
				}else{
					$pass=mysqli_real_escape_string($dbc, input_test($_POST['pass']));
					
					//make the query to select the username 
					
					$q="SELECT * FROM users WHERE email='$email'";
					$r=mysqli_query($dbc, $q);
					$num_row=mysqli_num_rows($r);
					
					if($num_row<1){
						$errors[]="Sorry your entry does not match our record";
					}else{
						$row=mysqli_fetch_array($r, MYSQLI_ASSOC);
						
						//veryfy the password
						
						$passCheck=password_verify($pass, $row['password']);
						
						if($passCheck==false){
							echo("Sorry the followwing error orrcured");
							
							foreach($errors as $message){
								echo("--<strong>$message</strong><br>\n");
								exit();
							}
						}elseif($passCheck==true){
							
							$_SESSION['user_level']=$row['user_level'];
							$_SESSION['fname']=$row['fname'];
							$_SESSION['email']=$row['email'];
							$_SESSION['lname']=$row['lname'];
							$_SESSION['user_id']=$row['user_id'];
							
							if($_SESSION['user_level']==1){
								header('Location: admin_page.php');
								exit();
							}elseif($_SESSION['user_level']==0){
								header('Location: index.php');
								exit();
							}
							
						}
						
					}
				}
			}
			
			function input_test($data){
				
				$data=htmlspecialchars($data);
				$data=trim($data);
				$data=stripcslashes($data);
				
				return $data;
			}
			
			?>			
	
			</div>
			
		
		<div class="col-md-2"></div>
	</div>
</div>








<?php
//include_once("footer.php");

?>
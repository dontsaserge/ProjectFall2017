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
			
			
					<div class="well">
				<form class="form-horizontal" method="POST" action="signin.inc.php">
				<p><a href="password_management.php">Forgot you password?</a></p>
				<hr class="my-4">
					<div class="form-group">
						<label class="control-label col-md-2">Email:</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Password:</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="pass">
						</div>
					</div>
					
					
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn btn-primary">Sign in</button>
							
							
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<a href="account.php"><i>Don't have account?</i></a>
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
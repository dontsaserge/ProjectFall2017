<?php
$page_title="User page";
include_once("header.inc.php");
//include_once("page-header.php");
include_once("jumbotron.php");
if(!isset($_SESSION['user_level']) || $_SESSION['user_level']!=0){
	header("Location: account.php");
}

?>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<h2>User Page</h2>

	</div>
	<div class="col-md-2"></div>
</div>









<?php
//include_once("footer.php");

?>
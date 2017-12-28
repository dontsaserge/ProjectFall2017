<?php
$page_title="Adminitrator Page";
include_once("header.inc.php");

if(!(isset($_SESSION['user_level'])) or isset($_SESSION['user_level'])!=1){
	header("Location: signin.php");
	exit();
}


include_once("jumbotron.php");
?>
<div class="row">
	<div class="col-md-2">
	<?php include_once("admin_main_menu.php") ?>
		
	</div>
	<div class="col-md-8">
		
	</div>
	<div class="col-md-2"></div>
</div>









<?php
include_once("footer.php");

?>
<?php
$page_title="Product Catalogue";
include_once("header.inc.php");
include('carousel.php');

?>
<div class="row">
	<div class="container">
	<?php
		
		include_once("mysqli_connect.php");
		
		//Default query for the page
		
		$sql="SELECT product_name, product_brand, product_price, product_image, product_description FROM product";
		
		?>
		
	</div>
</div>









<?php
include_once("footer.php");

?>
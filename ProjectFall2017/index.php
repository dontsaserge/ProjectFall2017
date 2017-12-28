<?php
$page_title="Home Page";
include_once("header.inc.php");

if(!isset($_SESSION['user_level'])){
	header("Location: signin.php");
	exit();
}


include_once("jumbotron.php");
//include('carousel.php');
include("mysqli_connect.php");

		echo('<div class="col-md-2"></div>');
		echo('<div class="col-md-8">');



		echo('</div>');
		echo('<div class="col-md-2"></div>');
			
			
		
	
?>
<div class="row">
	<div class="container">
	
		<?php
		//include('mysqli_connect.php');
		
		$query="SELECT * FROM product ORDER BY product_id ASC";
		$result=mysqli_query($dbc, $query);
		
		if(mysqli_num_rows($result)>0){
			
			
			
			while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
				
		
				
		?>
		<div class="col-md-3">
			<form method="POST" action="add_cart.php?id=<?php echo($row['product_id']); ?>">
				<div style="border: 1px thin #333; background-color: #f1f1f1; border-radius: 5px; padding-left: 7px; padding-right: 7px;">
					<li class="list-group-item active" style="padding: 1px; margin-bottom: 10px;"><h5 class="text-info" style="color:#000;"><?php echo($row['product_name']); ?></h5></li>
					<img src="upload_image/<?php echo($row['product_image']); ?>"  class="img-responsive"/>
					
					<h4 class="text-info">Brand:<strong> <?php echo($row['product_brand']); ?></strong></h4>
					<h4 class="text-info">Size:<strong> <?php echo($row['product_size']); ?></strong></h4>
					<h4 class="text-success">Condition:<strong> <?php echo($row['product_description']); ?></strong></h4>
					<h4 class="text-danger">Price: <strong>$ <?php echo($row['product_price']); ?></strong></h4>
					<input type="text" name="quantity" class="form-control" value="1"/>
					<input type="hidden" name="hidden_name" value="<?php echo($row['product_name']); ?>"/>
					<input type="hidden" name="hidden_price" value="<?php echo($row['product_price']); ?>"/>
					<input type="submit" name="add_to_cart" style="margin-top: 5px;" class="btn btn-primary btn-block" value="Add to Cart">
				</div>
				  
				    
			</form><br> 
		</div>
		
		
		<?php
		
							}
				
			
		}
		
		?>
		
		
		</div>
	

		

	</div>
</div>









<?php
include_once("footer.php");

?>
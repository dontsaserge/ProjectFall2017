<?php
$page_title="Product list";
include_once("header.inc.php");
//include_once("page-header.php");
include_once("jumbotron.php");
//include_once("includes/jumbotDESCRIPTIONhp");

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"><?php include_once('admin_main_menu.php');?></div>
		<div class="col-md-8">
			<?php
				include('mysqli_connect.php');
				//make the query
			
			$sql="SELECT * FROM product";
			//run the sql
			$result=mysqli_query($dbc, $sql);
			$num_row=mysqli_num_rows($result);
			echo("The system is currently have:<strong> $num_row products(s)");
			echo('<hr class="my-4">');
			//fetch the result
			echo('	<table class="table table-bordered">
				<thead style="background-color: #21313F; color:#fff;">
				<tr>
					<th>IMAGE</th>
					<th>NAME</th>
					<th>PRICE</th>
					<th>BRAND</th>
					<th>DESCRIPTION</th>
				</tr>
				</thead><tbody>');
				
				//<tbody>');
			
			while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
			
			?>
			<tr>
				<td><img src="upload_image/<?php echo($row['product_image']); ?>" width="50" height="50" class="img-responsive"/></td>
				<td><?php echo($row['product_name']);  ?></td>
				<td><?php echo($row['product_price']); ?></td>
				<td><?php echo($row['product_brand']); ?></td>
				<td><?php echo($row['product_description']); ?></td>
				
			</tr>
			
			
			
			<?php
			}
			echo('</tbody>');
			echo('</table>');
			
			
			?>
	
			
		
		
			</div>
			
		
		<div class="col-md-2"></div>
	</div>
</div>








<?php
include_once("footer.php");

?>
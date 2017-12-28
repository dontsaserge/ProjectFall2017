<?php
$page_title="View Cart";
include_once("header.inc.php");
//include_once("page-header.php");
include_once("jumbotron.php");
//include_once("includes/jumbotron.php");

?>
<div class="container-fluid">
	<div class="row" style="min-height: 500px;">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<table class='table table-bordered'>
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Porduct ID</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
		<?php
			$user_id=$_SESSION['user_id'];
			
			include('mysqli_connect.php');
			$sql="SELECT * FROM order_content WHERE user_id='$user_id'";
			$run=mysqli_query($dbc, $sql);
			
			while($row=mysqli_fetch_array($run, MYSQLI_ASSOC)){
				
			?>
		
						<tr>
							<td><?php echo($row['ordercon_id']);?></td>
							<td><?php echo($row['product_id']);?></td>
							<td><?php echo($row['quantity'])?></td>
							<td><?php echo($row['price']);?></td>
							<td><a href="view_cart.php?action=delete&id=<?php echo $row['product_id'];?>"><span class="text-danger">Remove</span></a></td>
						</tr>
					
			
			
			<?php
			
			}
						if(isset($_GET['action'])){
							if($_GET['action']=='delete'){
								$pid=$_GET['id'];
								$sql="DELETE FROM order_content WHERE product_id='$pid'";
								$run=mysqli_query($dbc, $sql);
							}
						}
			?>
			</tbody>
				
				
			</table>
		
	
			</div>
			
		
		<div class="col-md-2"></div>
	</div>
</div>















<?php
include_once("footer.php");

?>
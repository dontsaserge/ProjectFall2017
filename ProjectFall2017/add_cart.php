<?php
$page_title="Cart";
include_once("header.inc.php");
//include_once("page-header.php");
include_once("jumbotron.php");
include('mysqli_connect.php');
//include_once("includes/jumbotron.php");

?>
<div class="col-md-2"></div>
<div class="col-md-8">

	<?php
		if(isset($_POST['add_to_cart']))
		{
			if(isset($_SESSION['shopping_cart']))
			{
				$item_array_id=array_column($_SESSION['shopping_cart'], 'product_id');
				
				if(!in_array($_GET['id'], $item_array_id))
				{
					$count=count($_SESSION['shopping_cart']);
					$item_array=array(
				
						'product_id'		=> $_GET['id'],
						'product_name'		=> $_POST['hidden_name'],
						'product_price'		=> $_POST['hidden_price'],
						'product_quantity'	=> $_POST['quantity']
				
					);
					
					$_SESSION['shopping_cart'][$count]=$item_array;
				}else
				{
					echo('Item already added');
				}
			}
			else
			{
				$item_array=array(
				
				'product_id'		=> $_GET['id'],
				'product_name'		=> $_POST['hidden_name'],
				'product_price'		=> $_POST['hidden_price'],
				'product_quantity'	=> $_POST['quantity']
				
				);
				
				$_SESSION['shopping_cart'][0]=$item_array;
			}
		}

	
	if(isset($_GET['action'])){
		
		if($_GET['action']=='delete')
		{
			foreach ($_SESSION['shopping_cart'] as $keys=> $values)
			{
				if($values['product_id']== $_GET['id'])
				{
					unset($_SESSION['shopping_cart'][$keys]);
					echo('Product removed');
					$product_id=$_GET['id'];
					$user_id=$_SESSION['user_id'];
					
					$sql1="DELETE FROM order_content WHERE product_id='$product_id' AND user_id='$user_id'";
					$run1=mysqli_query($dbc, $sql1);
				}
			}
		}
	}
		
		?>
		
	
		<h2>Order Detail:</h2>
		<hr class="my-4">
		<table class="table table-bordered">
	<thead>
		<tr>
		<th>SKU</th>
		<th>NAME</th>
		<th>PRICE</th>
		<th>QUANTITY</th>
		<th>TOTAL</th>
		<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!empty($_SESSION['shopping_cart']))
		{
			$total=0;
			foreach($_SESSION['shopping_cart'] as $keys => $values)
			{
				
	?>
	
	<tr>
		<td><?php echo($values['product_id']); ?></td>
		<td><?php echo($values['product_name']); ?></td>
		<td>$ <?php echo($values['product_price']); ?></td>
		<td><?php echo($values['product_quantity']); ?></td>
		<td><?php echo(number_format($values['product_quantity']*$values['product_price'], 2)); ?></td>
		<td><a href="add_cart.php?action=delete&id=<?php echo($values['product_id']); ?>"><span class="text-danger">Remove</span> </a></td>
	</tr>
	
		
		<?php
				$total=$total+($values['product_quantity']*$values['product_price']);
				
				///-------------------------------------------------
				
				
				
				$user_id=$_SESSION['user_id'];
						$product_id=$values['product_id'];
						$product_name=$values['product_name'];
						$product_quantity=$values['product_quantity'];
						$product_price=$values['product_price'];
				
						$sql="INSERT INTO order_content (user_id, product_id, product_name, quantity, price, ship_date) VALUES('$user_id', '$product_id', '$product_name', '$product_quantity', '$product_price', NOW())";
						$run=mysqli_query($dbc, $sql);
					
				
			
			}
			?>
			
			<tr>
				<td colspan="4" align="right">Total</td>
				<td align="right">$ <?php echo(number_format($total, 2)); ?></td>
			</tr>
			
			<?php
			
				foreach($_SESSION['shopping_cart'] as $keys => $values)
				{
						
		
					
				
				}
		}
	
		?>

		

	
	

	
	
	
		</tbody>
	
</table>
	
	
	
	
	
</div>
<div class="col-md-2">
	<a href="index.php" class="btn btn-primary btn-block">Continue Shopping</a>
	
	<a href="#" class="btn btn-danger btn-block">Check Out</a>
	
	
	
</div>

<?php
//include_once("footer.php");

?>
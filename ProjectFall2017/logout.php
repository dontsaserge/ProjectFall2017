<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	
	session_start();
		

	//unset($_SESSION['shopping_cart']);
		foreach($_SESSION['shopping_cart'] as $keys => $values)
				{
						include('mysqli_connect.php');
		
						$user_id=$_SESSION['user_id'];
						$product_id=$values['product_id'];
						$product_name=$values['product_name'];
						$product_quantity=$values['product_quantity'];
						$product_price=$values['product_price'];
				
						$sql="INSERT INTO order_content (user_id, product_id, product_name, quantity, price) VALUES('$user_id', '$product_id', '$product_name', '$product_quantity', '$product_price', NOW())";
						$resul=mysqli_query($dbc, $sql);
				}
	session_unset();
	session_destroy();
	
	header("Location: index.php");
	exit();
}


?>
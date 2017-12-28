		<?php
					if($_SERVER['REQUEST_METHOD']=='POST'){
						require("mysqli_connect.php");
						
						$errors=array();
						
						//Check the product name
						if(!empty($_POST['pname'])){
							$pname=mysqli_real_escape_string($dbc, input_test($_POST['pname']));
						}else{
							$errors[]="You did not enter the product's name";
						}
						
						//Check the product brand
						if(!empty($_POST['pbrand'])){
							$pbrand=mysqli_real_escape_string($dbc, input_test($_POST['pbrand']));
						}else{
							$errors[]="You did not enter the product's brand";
						}
						//Check the product price
						if(!empty($_POST['pprice']) ||!is_numeric($_POST['pprice']) ||$_POST['price']<=0){
							$pprice=mysqli_real_escape_string($dbc, input_test($_POST['pprice']));
						}else{
							$errors[]="You did not enter the product's price";
						}
						
						//Check the size
						if(!empty($_POST['psize'])){
							$psise=mysqli_real_escape_string($dbc, input_test($_POST['psize']));
						}else{
							$errors[]="You did not enter the product's size";
						}
						
						//Check for an image
						
						if(is_uploaded_file($_FILES['image']['tmp_name'])){
							
							//create a temporay file name
							
							$temp='upload_image'.md5($_FILES['image']['name']);
							
							//move the file over
							
							if(move_uploaded_file($_FILES['image']['tmp_name'], $temp)){
								echo("<br>The product's image has been upladed<br>");
								
								//set the $i variable to the image's name
								
								$i=$_FILES['image']['name'];
							}else{
								$errors[]="Couldn't move the file over";
								$temp=$_FILES['image']['tmp_name'];
							}
						}else{
							$errors[]="No file was uploaded";
							$temp=NULL;
						}
						
						//check for the description
						$s=(!empty($_POST['description']))? trim($_POST['description']):NULL;
						
				
						
						if(!empty($errors)){
							foreach($errors as $mesage){
								echo("--<i>$mesage</i><br>\n");
							}
							echo('<hr class="my-4">');
						}
						else{//No error add the article to the databases
							$q="INSERT INTO product (product_name, product_brand, product_price, product_size, product_image, product_description) VALUES(?,?,?,?,?,?)";
							$stmt=mysqli_prepare($dbc, $q);
							mysqli_stmt_bind_param($stmt, 'isdsss', $pname, $pbrand, $pprice, $psise, $i, $s);
							mysqli_stmt_execute($stmt);
							
							//check the resutl
							if(mysqli_stmt_affected_rows($stmt)==1){
								echo"The product has been added";
								
								//Rename the image
								$id=mysqli_stmt_insert_id($stmt);
								rename($temp, "upload_image/$id");
								
								//clear $_post
								$_POST=array();
							}else{
								echo"Your submission could not be processed due to a system error";
							}
							
							mysqli_stmt_close($stmt);
							
						}
						
						//Delete the uploaded file if it still exists
						if(isset($temp) && file_exists($temp) && is_file($temp)){
							unlink($temp);
						}
						
						//check for any error and print them
						
						if(!empty($errors) && is_array($errors)){
							echo("<h3><strong>Error!</strong></h3>");
							echo("The following error(s) occured:<br>\n");
							
							foreach($errors as $msg){
								echo"-$msg<br>\n";
							}
							echo("Retry againt");
						}
				
					}
					
					function input_test($data){ 
						$data=htmlspecialchars($data);
						$data=trim($data);
						$data=stripcslashes($data);
						
						return($data);
					}
					
					
					?>


					------------------------

							
					<?php
						if($_SERVER['REQUEST_METHOD']=='POST'){
							
							require('mysqli_connect.php');
							
							$errors=array();
							
							//Valide the product's name
							
							if(empty($_POST['pname'])){
								$errors[]="You did not provide the product name";								
							}else{
								$pname=mysqli_real_escape_string($dbc, input_test($_POST['pname']));
							}
							
							//Valid the prduct's brond
							
							if(empty($_POST['pbrand'])){
								
								$errors[]="You did not provide the product name";
							}else{
								$pbrand=mysqli_real_escape_string($dbc, input_test($_POST['pbrand']));
							}
							
							//Valid the product price
							if(empty($_POST['pprice'])){
								$errors[]="You did not provide the product price";
							}elseif(!is_numeric($_POST['pprice'])){
								$errors[]="You have entered and invalid product price";
							}else{
								$pprice=mysqli_real_escape_string($dbc, input_test($_POST['pprice']));
							}
							
							//Valid the product size
							if(empty($_POST['psize'])){
								$errors[]="You did not provde the product size";
							}elseif(!is_numeric($_POST['psize'])){
								$errors[]="You have entered an invalid size";
							}else{
								$psize=mysqli_real_escape_string($dbc, input_test($_POST['psize']));
							}
							
							//Valid product description
							if(empty($_POST['pdesc'])){
								$errors[]="Please choose the product description";
							}else{
								$pdesc=mysqli_real_escape_string($dbc, input_test($_POST['pdesc']));
							}
							
							
							//-----	VALIDE THE IMAGE----------------
							
							
							if(is_uploaded_file($_FILES['image']['tmp_name'])){
								//Create a temporary file name
								
								$temp='upload_image' .md5($_FILES['image']['name']);
								
								//move the file over
								if(move_uploaded_file($_FILES['image']['tmp_name'], $temp)){
									
									echo"<p><strong>The product image has been uploaded</strong></p>";
									
									//Set the $i variable to the image's name
									
									$i=$_FILES['image']['name'];
								}else{
									$errors[]="The file could not be moved,";
									$temp=$_FILES['image']['tmp_name'];
								}
								
							}else{
								$errors[]="No file was uploaded";
								$temp=NULL;
							}	
						//ADD PRODUCT TO THE DATABSES
							
							$sql="INSERT INTO product (product_name, product_brand, product_price, product_size, product_image, product_description)
								VALUES ('$pname', '$pbrand', '$pprice', '$psize','$i', '$pdesc')";
							$result=mysqli_query($dbc, $sql);
							
							if($result){
								echo("<strong>Product sucessfully Uploaded </strong>");
							}else{
								echo("Error: Please try again"); 
							}
							
							if(!empty($errors)){
								foreach($errors as $message){
								echo("--$message<br>\n");
							}
							
							}
							
							
							
							
								
							
							
						}
						
					function input_test($data){
						$data=htmlspecialchars($data);
						$data=trim($data);
						$data=stripcslashes($data);
						return($data);
					}
					?>
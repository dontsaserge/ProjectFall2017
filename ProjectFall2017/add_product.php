<?php
$page_title="Add Product";
include_once("header.inc.php");

if(!isset($_SESSION['user_level']) || isset($_SESSION['user_level'])!=1){
	header("Location: signin.php");
	exit();
}
//include_once("page-header.php");
include_once("jumbotron.php");

?>
<style type="text/css">
body,td,th {
	font-size: 14px;
}
</style>

<div class="row">
	<div class="col-md-2">
		<?php 
		$class='active';
		include_once("admin_main_menu.php");
		
		?>
	</div>
	<div class="col-md-8">
		<div class="well">
			<h2><strong>Add Product</strong></h2>
		<hr class="my-4">
			<div class="row">
				<div class="col-md-8">
				<script>
					
					
				</script>
					<form enctype="multipart/form-data" action="add_product.php" method="POST">
						<input type="hidden" name="MAX_FILE_SIZE" value="524288"/>
						<div class="form-group">
							<label>Product Name:</label>
							<input type="text" class="form-control" name="pname">
						</div>
						
						<div class="form-group">
							<label>Product Brand:</label>
							<input type="text" class="form-control" name="pbrand">
						</div>
						<div class="form-group">
							<label>Product Price:</label>
							<input type="text" class="form-control" name="pprice">
						</div>
						<div class="form-group">
							<label>Size(inch):</label>
							<input type="text" class="form-control" name="psize">
						</div>
											
						<div class="form-group">
						<label>Product Description</label>
						<div class="dropdown">
							<select class="form-control" name="pdesc">
								<option value="" selected="selected"><strong>Select Description</strong></option>
								<option value="Brand New">Brand New</option>
								<option value="Used">Used</option>
								<option value="Refurbished">Refurbished</option>
							</select>
							
						</div>
							
						</div>
						<div class="form-group">
						<label class="control-label">Upload Product image:</label>
						 <input type="file" name="file" class="btn btn-default">
  							
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
				<div class="col-md-4">
									<?php
						if($_SERVER['REQUEST_METHOD']=='POST'){
							
							include_once('mysqli_connect.php');
							
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
							
							$file=$_FILES['file'];


							$fileName=$_FILES['file']['name'];
							$fileTmpName=$_FILES['file']['tmp_name'];
							$fileSize=$_FILES['file']['size'];
							$fileError=$_FILES['file']['error'];
							$fileType=$_FILES['file']['type'];


							$fileExt=explode('.', $fileName);
							$fileActualExt=strtolower(end($fileExt));

							$allawed=array('jpg', 'jpeg', 'png', 'JPEG', 'JPG');

							if (in_array($fileActualExt, $allawed)) {
		
							if($fileError===0){
								
							if($fileSize<500000000){

							$fileNameNew=uniqid('', true).".".$fileActualExt;	

							$fileDestination='upload_image/'.$fileNameNew;

							move_uploaded_file($fileTmpName, $fileDestination);
								
							echo("The file was sucessfully uploaded<br>\n");
					//header("Location: index.php?uploadsuccess");
				}else{
					$errors[] ="You file is too big";
				}
		}else{
			$errors[] = "There was an error uploading your file";
		}
	}else{
		$errors[] = "You canot upload files of this type";
	}

						if(empty($errors)){
								$sql="INSERT INTO product (product_name, product_brand, product_price, product_size, product_image, product_description)
								VALUES ('$pname', '$pbrand', '$pprice', '$psize','$fileNameNew', '$pdesc')";
							$result=mysqli_query($dbc, $sql);
							
							if($result){
								echo("<strong>Product sucessfully Uploaded </strong>");
							}else{
								echo("Error: Please try again"); 
							}
						}else{
							foreach($errors as $message){
								echo("-- $message<br>\n");
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
				</div>
			</div>
		</div>
	
	
	
	</div>
	<div class="col-md-2"></div>
</div>









<?php
include_once("footer.php");

?>
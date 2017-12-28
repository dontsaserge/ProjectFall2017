		
				echo('<div class="col-md-3">
				<div class="thumbnail">
				<li class="list-group-item active"><strong>'.$row['product_name'].'</strong></li>
				<img src="upload_image/'.$row['product_image'].'" width="260" height="210">
				<div class="caption">
				<p>Price: $<strong> '.$row['product_price'].'</strong></p>
				<p>Description: <strong>'.$row['product_description'].'</strong></p>
				<p>Brand: <strong>'.$row['product_brand'].'</strong></p>
				<p>Display: <strong>'.$row['product_size'].'</strong></p>
				<form class="form-horizontal" metho="POST">
				<div class="form-group">
				<label class="control-label col-md-3">Quantity:</label>
				<div class="col-md-9">
				<input type="text" class="form-control" value="1">
				</div>
				</div>
				
				<div class="form-group"><button type="submit" class="btn btn-primary btn-block">Add to Cart</button></div>
				<form>
				</div>
				</div>	
				</div>');
<?php
$page_title="View Users";
include_once("header.inc.php");
include("jumbotron.php");

if(!isset($_SESSION['user_level']) or isset($_SESSION['user_level'])!=1){
	header("Location: signin.php");
	exit();
}
//include('carousel.php');

?>
<div class="row">
	<div class="col-md-2">
	<?php include_once('admin_main_menu.php') ?>
	</div>
	<div class="col-md-8">
	
	<?php
		require('mysqli_connect.php');
		
		//make the query to retrieve the data from the databases
		
		$sql="SELECT user_id, fname, lname, email, DATE_FORMAT(registration_date, '%M, %d, %Y') as regdate, user_level FROM users";
		//run the data
		$run=mysqli_query($dbc, $sql);
		
		//count the number of row
		$num_row=mysqli_num_rows($run);
		//fetch the resul
		
		$row=mysqli_fetch_array($run, MYSQLI_ASSOC);
		
		echo("<h4>There are currently<strong> $num_row</strong> users</h4>");
		
		echo('<hr class="my-4">');
		
		
		if($num_row>0){
			echo('<form class="form-inline" method="POST" action="#">
				<div class="form-group">
				<input type="email" class="form-control" placeholder="Search by email">
				<button type="submit" class="btn btn-primary">Search</button>
				</div>
				</form><br>');
		
			echo('<table  class="table table-bordered"DELETE>');
			echo('<thead style="background-color: #21313F; color:#fff;">
				<tr>
					<td><b>EDIT</b></td><td><b>DELETE</b></td><td><b>USER ID</b></td><td><b>FIRST NAME</b></td><td><b>LAST NAME</b></td><td><b>EMAIL</b></td><td><b>REGISTRATION DATE</b></td><td><b>USER LEVEL</b></td>
					
				</tr>
			</thead>');
			while($row=mysqli_fetch_array($run, MYSQLI_ASSOC)){
				echo'<tbody>
							<tr>
								
								<td><a href="edit_user.php?id='.$row['user_id'].'">Edit</a></td>
								<td><a href="delete_user.php?id='.$row['user_id'].'">Delete</a></td>
								<td>'.$row['user_id'].'</td>
								<td>'.$row['lname'].'</td>
								<td>'.$row['fname'].'</td>
								<td>'.$row['email'].'</td>
								<td>'.$row['regdate'].'</td>
								<td>'.$row['user_level'].'</td>
							</tr>
						</tbody>';
			}
		
		}
			
		
		echo("</table>");
		
		
		
		?>
	
	</div>
	<div class="col-md-2"></div>
</div>









<?php
include_once("footer.php");

?>
<html>
<head>
<link href = "css_m.css" rel = "stylesheet" type = "text/css" >
<title>Start Page</title>
<style type = "text/css">
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		background-color: #CCC;
	}	
</style>
</head>
<body>
<?php
	//header("Location: bid_table_check.php");
	include "bid_table_check.php";
?>
<div id = "Container">

	<div id = "Top">
		<div style = "height : 100%; width : 40%; float : left; background-color : #6CA1DA"><h1><a href = "startpage.php">Online Auction System</a></h1></div>
		<div style = "height : 100%; width : 10%; float : right; background-color : #6CA1DA">
			<p align = 'right'><a href = "login.php"><b><u>Log In</u></b></a> <a href = "signupinfo.php"><b><u>Sign Up</u></b></a></p>
			<form method = "post" action = "productform.php" align = "right">
				<input type = "submit" value = "Add your item!">
			</form>
		</div>
	</div>
	<div id = "Search">
		<form method = 'post' action  = 'search.php'>
			<input type = 'text' name = 'product_name' placeholder = 'Product Name' style = 'width : 46.5%; height : 80%; margin-top : .4%'>
			<select name = "status" style = "width : 40% height : 80%; margin-top : .4%; padding : .7%; background-color : white; font-size : 15px">
					<option value = "ongoing" style = "font-size : 15px">Ongoing</option>
					<option value = "finished" style = "font-size : 15px">Finished</option>
					<option value = "yet to bid" style = "font-size : 15px">Yet To Bid</option>
			</select>
			<button type = 'submit' name = 'search' style = 'width : 10%; height : 80%; margin-top : .4% padding : .7%; font-size : 15px; background-color : #6CA1DA'>Search</button>
		</form>
	</div>
	<div id = "Sidebar">
		<div id = "Ongoing" style = "width : 100%; height : 50%; background-color : #E0E7F4">
			<div style = "width : 99%; height : 10%; background-color : white; border : 1px solid; border-color : white white black white"><h3 align = 'center' style = 'color : green; margin-top : 2px'><u>Ongoing Bid!</u></h3></div>
			<?php
				$user = "root";
				$pass = "";
				$db = "online_auction_system";
				
				$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");
				//echo "Database Connected"."<br>";
				
				$qry = "SELECT product.Product_Name, locations.Name, product.Initial_Bid, bid.Status, time_track.Start_Time, time_track.End_Time, bid.Bid_ID
						FROM product, bid, locations, time_track 
						WHERE product.Product_ID = bid.Bid_ID AND product.Location = locations.ID 
							AND time_track.Track_ID = product.Product_ID AND bid.Status LIKE 'ongoing'";
				$res = mysqli_query($db_connect, $qry);
				echo '<table>';
						$cnt = 0;
						while($row = mysqli_fetch_assoc($res))
						{
							if($cnt > 3)break;
							echo '<tr>';
							echo '<td align = "center" style = "border : 1px solid">' . $row['Product_Name'] . '</td>';
							echo '<td align = "center" style = "border : 1px solid ; padding-top : 15px">' . '<form method = "post" action = "item_details.php"><button name = "details" type = "submit" value = ' . $row['Bid_ID'] . '>Details</button></form></td>';
							echo '</tr>';
							$cnt++;
						}
				echo '</table>';
			?>
		</div>
		<div id = "Yet To Bid" style = "width : 100%; height : 50%; background-color : #E0E7F4">
			<div style = "width : 99%; height : 10%; background-color : white; border : 1px solid; border-color : white white black white"><h3 align = 'center' style = 'color : orange; margin-top : 2px'><u>Yet To Bid!</u></h3></div>
			<?php
				$user = "root";
				$pass = "";
				$db = "online_auction_system";
				
				$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");
				//echo "Database Connected"."<br>";
				
				$qry = "SELECT product.Product_Name, locations.Name, product.Initial_Bid, bid.Status, time_track.Start_Time, time_track.End_Time, bid.Bid_ID
						FROM product, bid, locations, time_track 
						WHERE product.Product_ID = bid.Bid_ID AND product.Location = locations.ID 
							AND time_track.Track_ID = product.Product_ID AND bid.Status LIKE 'yet to bid'";
				$res = mysqli_query($db_connect, $qry);
				echo '<table>';
						$cnt = 0;
						while($row = mysqli_fetch_assoc($res))
						{
							if($cnt > 1)break;
							echo '<tr>';
							echo '<td align = "center">' . $row['Product_Name'] . '</td>';
							echo '<td align = "center">' . '<form method = "post" action = "item_details.php"><button name = "details" type = "submit" value = ' . $row['Bid_ID'] . '>Details</button></form></td>';
							echo '</tr>';
							$cnt++;
						}
				echo '</table>';
			?>
		</div>
	</div>
	<div id = "Mainpanel">
		<?php
		
			$product_name = $_POST['product_name'];
			$status = $_POST['status'];
			
			$user = "root";
			$pass = "";
			$db = "online_auction_system";
			
			$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");
			//echo "Database Connected"."<br>";
			if(strlen($product_name) == 0)
			{
				$qry = "SELECT product.Product_Name, locations.Name, product.Initial_Bid, bid.Status, time_track.Start_Time, time_track.End_Time, bid.Bid_ID
							FROM product, bid, locations, time_track 
									WHERE product.Product_ID = bid.Bid_ID AND product.Location = locations.ID 
										AND time_track.Track_ID = product.Product_ID AND bid.Status LIKE '$status'";
			}
			else
			{
				$qry = "SELECT product.Product_Name, locations.Name, product.Initial_Bid, bid.Status, time_track.Start_Time, time_track.End_Time, bid.Bid_ID
							FROM product, bid, locations, time_track 
									WHERE product.Product_ID = bid.Bid_ID AND product.Location = locations.ID 
										AND time_track.Track_ID = product.Product_ID AND bid.Status LIKE '$status' AND product.Product_Name LIKE '%" . $product_name . "%'";
				
			}
			$res = mysqli_query($db_connect, $qry);
			$cnt = 0;
			echo '<table><th>Product Name</th><th>Location</th><th>Initial Bid</th><th>Status</th><th>Bid Start Time</th><th>Bid End Time</th><th>Product Details</th>';
					while($row = mysqli_fetch_assoc($res))
					{
						if($cnt >= 9)
							break;
						echo '<tr>';
						/*$name = $row['Product_Name'];
						$loc = $row['Name'];
						$start_bid = $row['Initial_Bid'];
						$status = $row['Status'];*/
						echo '<td align = "center">' . $row['Product_Name'] . '</td>';
						echo '<td align = "center">' . $row['Name'] . '</td>';
						echo '<td align = "center">' . $row['Initial_Bid'] . '</td>';
						echo '<td align = "center">' . $row['Status'] . '</td>';
						echo '<td align = "center">' . $row['Start_Time'] . '</td>';
						echo '<td align = "center">' . $row['End_Time'] . '</td>';
						echo '<td align = "center">' . '<form method = "post" action = "item_details.php"><button name = "details" type = "submit" value = ' . $row['Bid_ID'] . '>Details</button></form></td>';
						echo '</tr>';
						$cnt++;
					}
			echo '</table>'
		?>
	</div>

</div>



</body>
</html>
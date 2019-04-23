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
							if($cnt > 2)break;
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
			$user = "root";
			$pass = "";
			$db = "online_auction_system";
			
			$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");

			//echo "Database Connected"."<br>";
			$bid_id = $_POST['details'];
			$qry = "SELECT product.Product_ID, product.Product_Name, product.Category, product.Description,
						product.Seller_ID, product.Initial_Bid, bid.Status, bid.Bid_ID, bid.Top_Bid, bid.Top_Bidder_ID, time_track.Start_Time, time_track.End_Time 
							FROM bid, product, time_track 
								WHERE Bid_ID = '$bid_id' AND bid.Product_ID = product.Product_ID AND bid.Time_Track = time_track.Track_ID";
			$res = mysqli_query($db_connect, $qry);
			$row = mysqli_fetch_assoc($res);
			//echo $row['Product_Name'] . " " . $row['Category'] . " " . $row['Top_Bid'] . " " . $row['Top_Bidder_ID'] . " " . $row['Start_Time'] . " " . $row['End_Time'] . " " . $row['Status'] . "<br>";
			echo "<div style = 'width : 450px; height : 100%; background-color : white; float : left'>";
				echo "<image src = 'image.png' style = 'margin-left : 20%; margin-top : 3%'>";
				echo "<h3 style = 'margin-left : 20%; color : blue'>BID ID : " . $row['Bid_ID'] . "</h3>";
				echo "<h4 style = 'margin-left : 20%'>Product Name : " . $row['Product_Name'] . "</h4>";
				echo "<h4 style = 'margin-left : 20%'>Category : " . $row['Category'] . "</h4>";
				echo "<h4 style = 'margin-left : 20%'>Bid Start Time : " . $row['Start_Time'] . "</h4>";
				echo "<h4 style = 'margin-left : 20%'>Bid End Time : " . $row['End_Time'] . "</h4>";
				echo "<h4 style = 'margin-left : 20%'>Initial Bid : " . $row['Initial_Bid'] . "</h4>";
				echo "<h4 style = 'margin-left : 20%'>Status : " . $row['Status'] . "</h4>";
				echo "<h4 style = 'margin-left : 20%'>Description : " . $row['Description'] . "</h4>";
			echo "</div>";
			//echo $bid_id;
			echo "<div style = 'width : 450px; height : 100%; float : right; background-color : white'>";
				if(strcmp($row['Status'], "ongoing") == 0){
					echo "<h2 style = 'margin-left : 32%; margin-top : 10%'>Status : <font color = 'green'>Ongoing</h2>";
					echo "<table style = 'border-collapse : collapse; width : 50%' align = center><tr><th colspan = 2>Top Bid</th></tr>";
						if($row['Top_Bidder_ID'] == $row['Seller_ID'])
							echo "<td colspan = 2 align = 'center'><b>Haven't Bid Yet</b></td>";
						else 
							echo "<td align = 'center'>" . $row['Top_Bidder_ID'] . "</td><td align = 'center'>" . $row['Top_Bid'] . "</td>";
					echo "</table>";
					echo "<br><br>";
					echo "<h2 align = center><font color = 'red'>Bid Now!</font></h2>";
					echo "<form action = 'Bid_update.php' align = 'center' method = 'post'>";
						//echo "<input type = 'text' name = 'bid_id' placeholder = 'Bid ID' style = 'height : 40px; width : 225px; font : 35px'><br>";
						echo "<input type = 'text' name = 'bidder_id' placeholder = 'Your ID' style = 'height : 40px; width : 225px; font : 35px'><br>";
						echo "<input type = 'text' name = 'new_bid' placeholder = 'Your Bid' style = 'height : 40px; width : 225px; font : 35px'><br>";
						echo "<button type = 'submit' name = 'bid' value = " . $bid_id . " style = 'background-color : #CCC; padding : 7px 10px'>BID</button>";
					echo "</form>";
						
				}
				else if(strcmp($row['Status'], "yet to bid") == 0)
					echo "<h2 style = 'margin-left : 35%; margin-top : 20%'>Status : <font color = 'red'>Yet To Bid</h2>";
				else 
				{
					echo "<h2 style = 'margin-left : 32%; margin-top : 15%'>Status : <font color = 'red'>Finished</h2>";
					echo "<table style = 'border-collapse : collapse; width : 50%' align = center><tr><th colspan = 2>Top Bid</th></tr>";
						if($row['Top_Bidder_ID'] == $row['Seller_ID'])
							echo "<td colspan = 2 align = 'center'><b>No Bid Happened</b></td>";
						else 
							echo "<td align = 'center'>" . $row['Top_Bidder_ID'] . "</td><td align = 'center'>" . $row['Top_Bid'] . "</td>";
				}
			echo "</div>";
		?>
	</div>

</div>



</body>
</html>
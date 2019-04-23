<?php

	$bidder_id = $_POST['bidder_id'];
	$bid_id = $_POST['bid'];
	$new_bid = $_POST['new_bid'];
	
	$user = "root";
	$pass = "";
	$db = "online_auction_system";
	$_GET['bid_ok'] = 1;
			
	$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");
	//echo $bidder_id, $bid_id, $new_bid;
	
	$qry = "SELECT Top_Bid FROM bid WHERE Bid_ID = '$bid_id'";
	$res = mysqli_query($db_connect, $qry);
	$row = mysqli_fetch_assoc($res);
	$prev_top_bid = $row['Top_Bid'];
	if($new_bid <= $prev_top_bid)
	{
		echo "<h2 align = center><font color = red>You Bid Must Heigher Than Previous One!</font></h2>";
		echo "<form align = 'center' method = 'post' action = 'item_details.php'><button style = 'background-color : #CCC; padding : 7px 10px' name = 'details' type = 'submit' value = " . $bid_id . ">Item Details</button></form>";
	}
	else
	{
		$qry = "UPDATE bid SET Top_Bid = '$new_bid', Top_Bidder_ID = '$bidder_id' WHERE Bid_ID = '$bid_id'";
		mysqli_query($db_connect, $qry);
		$_POST['details'] = $bid_id;
		include("item_details.php");
	}
?>
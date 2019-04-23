<?php

	date_default_timezone_set("Asia/Dhaka");
	$product_name = $_POST['pname'];
	$seller_id = $_POST['sid'];
	$initial_bid = $_POST['ini_bid'];
	$category = $_POST['category'];
	$location = $_POST['location'];
	$bid_s_time = $_POST['starttime'];
	$bid_e_time = $_POST['endtime'];
	$description = $_POST['description'];
	
    /*echo "product_name is : $product_name"."<br>";
    echo "seller_id is : $seller_id"."<br>";
    echo "initial_bid is : $initial_bid"."<br>";
    echo "category is : $category"."<br>";
    echo "location is : $location"."<br>";
    echo "bid_s_time is : $bid_s_time"."<br>";
    echo "bid_e_time is : $bid_e_time"."<br>";
    echo "description : $description"."<br>";*/

	$user = "root";
    $pass = "";
    $db = "online_auction_system";
	
	$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");
	
	echo "database connected";
	
	$time_trackID = mysqli_num_rows(mysqli_query($db_connect, "SELECT * FROM time_track")) + 1;
	echo "$time_trackID"."<br>";
	$qry = "INSERT INTO time_track VALUES ('$time_trackID', '$bid_s_time', '$bid_e_time')";
	$qry_exec = mysqli_query($db_connect, $qry);
	
	$qry = "SELECT ID FROM locations WHERE Name = '$location'";
	$qry_exec = mysqli_query($db_connect, $qry);
	$row = mysqli_fetch_assoc($qry_exec);
	$location_id = $row['ID'];
	
	$product_id = mysqli_num_rows(mysqli_query($db_connect, "SELECT * FROM product")) + 1;
	echo "$product_id"."<br>";
	$qry = "INSERT INTO product VALUES ('$product_id', '$product_name', '$category', '$initial_bid', '$description', '$seller_id', '$location_id', '$time_trackID', '1')";
	$qry_exec = mysqli_query($db_connect, $qry);
	
	$bid_id = mysqli_num_rows(mysqli_query($db_connect, "SELECT * FROM bid")) + 1;
	/*if($bid_e_time < date("h:i:s"))
	{
		$status = "yet to bid";
	}
	else if($bid_s_time <= date("h:i:s") && $bid_e_time >= date("h:i:s"))
	{
		$status = "ongoing";
	}
	else if($bid_s_time > date("h:i:s"))
	{
		$status = "finished";
	}*/
	/*$date = date('Y-m-d h:i', time());
	list($dat, $tm) = explode('T', $bid_s_time);
	
	$bid_s_time = $dat." ".$tm;
	$timestamp = new DateTime($bid_s_time);
	$timestamp = $timestamp->getTimestamp();
	
	echo "$dat "."$tm "."$bid_s_time "."$timestamp"."<br><br>";
	
	//$date = strftime('%Y-%m-%dT%H:%M', strtotime($bid_s_time));
	
	echo "$bid_s_time"." "."$bid_e_time "."$date"."<br>";*/
	
	$nt = new DateTime($bid_s_time);
	$bid_s_time = $nt->getTimestamp();
	
	
	$nt = new DateTime($bid_e_time);
	$bid_e_time = $nt->getTimestamp();
	
	$date = time();
	
	echo "$bid_s_time"." "."$bid_e_time "."$date"."<br>";
	if($bid_s_time > $date)
	{
		$status = "yet to bid";
	}
	else if($bid_s_time <= $date && $bid_e_time >= $date)
	{
		$status = "ongoing";
	}
	else if($bid_e_time < $date)
	{
		$status = "finished";
	}
	$qry1 = "INSERT INTO bid VALUES ('$bid_id', '$status', '$initial_bid', '$seller_id', '$product_id', '$seller_id', '$time_trackID')";
	$qry_exec1 = mysqli_query($db_connect, $qry1);
	
	if($qry_exec && $qry_exec1)
	{
		echo "Successfylly added";
		header("Location: startpage.php");
	}
	
?>
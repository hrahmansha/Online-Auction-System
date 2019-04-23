<?php

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$passward = $_POST['passward'];
	$contact = $_POST['contact_no'];
	$location = $_POST['location'];
	
    /*echo "fname is : $fname"."<br>";
    echo "lname is : $lname"."<br>";
    echo "email is : $email"."<br>";
    echo "passward is : $passward"."<br>";
    echo "contact_no is : $contact"."<br>";
    echo "location is : $location"."<br>";*/

	$user = "root";
    $pass = "";
    $db = "online_auction_system";
	
	$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");
    //echo "Database Connected";
	
	$qry = "SELECT *FROM userinfo WHERE Email LIKE '$email'";
	$res = mysqli_query($db_connect, $qry);
	$row = mysqli_num_rows($res);
	if($row > 0)
	{
		echo "<center><h3><font color = 'red'>Email Already Exist.</font></h3><form method = 'post' action = 'signupinfo.php'><button style = 'background-color : #CCC; padding : 7px 10px' name = 'signup' type = 'submit'>Back to signup page</button></form></center>";
	}
	else
	{
		$qry = "SELECT ID FROM locations WHERE Name = '$location'";
		$res = mysqli_query($db_connect, $qry);
		$row = mysqli_fetch_assoc($res);
		$location_id = $row['ID'];
		
		$user_ID = mysqli_num_rows(mysqli_query($db_connect, "select * from userinfo")) + 1;
		
		$qry = "INSERT INTO userinfo values ('$user_ID', '$fname', '$lname', '$email', '$contact', '$passward', '$location_id')";
		$f = mysqli_query($db_connect, $qry);
		if($f)
		{
			echo "Successfylly signUP";
			header("Location: startpage.php");
		}
	}
?>
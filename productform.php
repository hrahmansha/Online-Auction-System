<html>
<head>
<title>SignUp</title>
</head>
<body>

<form method = "post" action = "add_item_to_database.php">
	<center>
	<br><br><br><br><br><br>
	Product Name	: <input type = "text" name = "pname"  > <br><br>
	Seller ID		: <input type = "text" name = "sid" > <br><br>
	Initial Bid		: <input type = "text" name = "ini_bid" > <br><br>
	Category		: <select name = "category">
						<option value = "Electronics">Electronics</option>
						<option value = "Vehicle">Vehicle</option>
						<option value = "Property">Property</option>
						<option value = "Garments">Garments</option>
					</select><br><br>
	Location		: <select name = "location">
						<option value = "Dhaka">Dhaka</option>
						<option value = "Chittagong">Chittagong</option>
						<option value = "Sylhet">Sylhet</option>
						<option value = "Rajshahi">Rajshahi</option>
						<option value = "Khulna">Khulna</option>
						<option value = "Barisal">Barisal</option>
						<option value = "Rangpur">Rangpur</option>
					</select><br><br>
	Bid Start Time 	: <input type = "datetime-local" name = "starttime"><br><br>
	Bid End Time 	: <input type = "datetime-local" name = "endtime"><br><br>
	Description		: <textarea rows = "4" cols = "20"  name = "description"></textarea><br><br>
	<input type = "submit" value = "Sign UP">
	</center>
</form>

</body>
</html>
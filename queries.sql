
SELECT *FROM userinfo WHERE Email LIKE 'shamimmahmed04@gmail.com'

SELECT MAX(Track_ID) as ID FROM time_track

SELECT *
FROM bid, product
WHERE bid.Bid_ID = product.Product_ID AND bid.Status LIKE "ongoing"

SELECT product.Product_Name, locations.Name, product.Initial_Bid, bid.Status 
FROM product, bid, locations 
WHERE product.Product_ID = bid.Bid_ID AND product.Location = locations.ID AND bid.Status IN ('ongoing', 'yet to bid')

SELECT product.Product_Name, locations.Name, product.Initial_Bid, bid.Status, time_track.Start_Time, time_track.End_Time
FROM product, bid, locations, time_track 
WHERE product.Product_ID = bid.Bid_ID AND product.Location = locations.ID 
		AND time_track.Track_ID = product.Product_ID AND bid.Status IN ('ongoing', 'yet to bid')

		
SELECT product.Product_Name, locations.Name, product.Initial_Bid, bid.Status, time_track.Start_Time, time_track.End_Time, bid.Bid_ID
FROM product, bid, locations, time_track 
WHERE product.Product_ID = bid.Bid_ID AND product.Location = locations.ID 
	AND time_track.Track_ID = product.Product_ID AND bid.Status IN ('ongoing', 'yet to bid')
	
	
	
SELECT product.Product_ID, product.Product_Name, product.Category, product.Description,
	product.Seller_ID, product.Initial_Bid, bid.Status, bid.Top_Bid, bid.Top_Bidder_ID, time_track.Start_Time, time_track.End_Time 
		FROM bid, product, time_track 
			WHERE Bid_ID = 2 AND bid.Bid_ID = product.Product_ID AND bid.Time_Track = time_track.Track_ID
			
			
SELECT Top_Bid FROM bid WHERE Bid_ID = 3

SELECT product.Product_Name, locations.Name, product.Initial_Bid, bid.Status, time_track.Start_Time, time_track.End_Time, bid.Bid_ID
	FROM product, bid, locations, time_track 
		WHERE product.Product_ID = bid.Bid_ID AND product.Location = locations.ID 
			AND time_track.Track_ID = product.Product_ID AND bid.Status LIKE '$status' AND product.Product_Name LIKE '%" . $product_name . "%'
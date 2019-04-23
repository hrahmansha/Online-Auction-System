<?php


	date_default_timezone_set("Asia/Dhaka");
    $user = "root";
    $pass = "";
    $db = "online_auction_system";
	
	$db_connect = mysqli_connect("localhost", $user, $pass, $db) or die("no database found");
    //echo "Database Connected"."<br>";
    
    $qry = "SELECT * FROM bid, time_track  WHERE time_track.Track_ID = bid.Time_Track";
    $res = mysqli_query($db_connect, $qry);
    while($row = mysqli_fetch_assoc($res)){
        $bid_s_time = $row['Start_Time'];
        $bid_e_time = $row['End_Time'];
        $bid_id = $row['Bid_ID'];
        //echo "$bid_s_time "."$bid_e_time"."<br>";


        $nt = new DateTime($bid_s_time);
        $bid_s_time = $nt->getTimestamp();


        $nt = new DateTime($bid_e_time);
        $bid_e_time = $nt->getTimestamp();

        $date = time();
        //echo "$bid_s_time "."$bid_e_time "."$date"."<br>";
        
        if($bid_s_time <= $date && $bid_e_time >= $date)
        {
            $qry = "UPDATE bid SET Status = 'ongoing' WHERE Bid_ID = '$bid_id'";
            mysqli_query($db_connect, $qry);
        }
        else if($bid_s_time > $date)
        {
            $qry = "UPDATE bid SET Status = 'yet to bid' WHERE Bid_ID = '$bid_id'";
            mysqli_query($db_connect, $qry);
        }
        else
        {
            $qry = "UPDATE bid SET Status = 'finished' WHERE Bid_ID = '$bid_id'";
            mysqli_query($db_connect, $qry);
        }
    }
    
?>
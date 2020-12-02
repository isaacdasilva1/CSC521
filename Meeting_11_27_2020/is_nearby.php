<?php 
					 //lat 1    //long 1 .  //lat 2 . //long 2
function get_location($loc_lat, $loc_long, $user_lat, $user_long)
{
	$earth_radius = 3963;
	
	$distance_latitude = deg2rad($user_lat-$loc_lat);
	$distance_longitude = deg2rad($user_long-$loc_long);
	
	$a = sin($distance_latitude/2) *sin($distance_latitude/2) + cos(deg2rad($loc_lat)) * cos(deg2rad($user_lat)) * sin($distance_longitude/2) + sin($distance_longitude/2);
	$c = 2 * asin(sqrt($a));
	$distance = $earth_radius * $c;
	
	return $distance;
}

?>
<?php

	//Script used to set and get the premium account info. ( true or false );
	//http://www.b-0.info/mmo_iphone/premium.php?user_id=18&method=get
	include ("db_connect.php");
	
	$user = $_GET['user_id'];
	$method = $_GET['method']; //"get" or "set"
	
	if( $method == "set" )
	{
		mysql_query( "UPDATE users SET premium = 1 WHERE id = $user" );
		echo "done";
	}
		
	if( $method == "get" )
	{
		$result  = mysql_query( "SELECT premium FROM users where id = $user" );
		$rows = mysql_num_rows($result);
		if ($rows > 0)
		{
			$row = mysql_fetch_array($result);
			$premium = $row['premium'];
			if( $premium == 1)
				echo "true";
			else
				echo "false";			
		}		
	}		
?>
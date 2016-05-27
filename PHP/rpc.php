<?php
	// PHP5 Implementation - uses MySQLi.
	// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
		$DB_Username="admin";
		$DB_Password="asdfg";
		$DB_Name="Photos";
	$db = new mysqli('127.0.0.1',$DB_Username,$DB_Password,$DB_Name);
	
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			// Is the string length greater than 0?
			if(strlen($queryString) >0) {
				$query = $db->query("SELECT Tag FROM tags WHERE Tag LIKE '%" . $queryString . "%' group by Tag ORDER BY Tag LIMIT 8;");
				
				if($query) {
					while ($result = $query ->fetch_object()) {
	         			$name = $result->Tag;
	         			if(strlen($name) > 35) { 
	         				$name = substr($name, 0, 35) . "...";
	         			}
							
	         			echo '<div class="searchheading">';
							echo '<a href="#" class="searchheading" onclick="fill(\''.$name.'\')">';
								echo $name;
							echo '</a>';
	         			echo '</div>';
	         			//echo '<br>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>

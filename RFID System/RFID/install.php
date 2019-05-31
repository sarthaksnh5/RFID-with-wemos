<?php
	//Connect to database
    $servername = "localhost";
    $username = "root";		//put your phpmyadmin username.(default is "root")
    $password = "";			//if your phpmyadmin has a password put it here.(default is "root")
    $dbname = "";
    
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Create database
	$sql = "CREATE DATABASE nodemculog";
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}

	echo "<br>";

	$dbname = "nodemculog";
    
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "CREATE TABLE IF NOT EXISTS `new_logs` (
  		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  		`cardid` TEXT DEFAULT NULL,
  		`name` TEXT DEFAULT NULL,
  		`serialno` TEXT NOT NULL,
  		`gender` TEXT DEFAULT NULL,
  		`Time` TIMESTAMP DEFAULT NULL
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=264";

	if ($conn->query($sql) === TRUE) {
	    echo "Table new_logs created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$sql = "CREATE TABLE IF NOT EXISTS `new_users` (
 		
  		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  		`cardid` TEXT DEFAULT NULL,
  		`name` TEXT DEFAULT NULL,
  		`serialno` TEXT NOT NULL,
  		`gender` TEXT DEFAULT NULL,
		`card_sel` int(11) unsigned NOT NULL,
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58";

	if ($conn->query($sql) === TRUE) {
	    echo "Table users created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}
		
	$conn->close();
?>
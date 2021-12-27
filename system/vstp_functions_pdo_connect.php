<?php 
// Detect server and connect to the relevant database
// SS added: 25/12/2021.

function PDOConnect()
{
    try {
        if(strpos($_SERVER['HTTP_HOST'], 'localhost') !== false)
			{
				// running from localhost on pc eg xampp or similar.
				$servername = "127.0.0.1";

				$username = "root";	// local server
				$password = "pswd";
				
				$pdoConn = new PDO("mysql:host=$servername;dbname=vestiaire_test_ss", $username, $password);
				// set the PDO error mode to exception
				$pdoConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//echo "Connected successfully";
				return $pdoConn;

			}
			else
			{
				// some other domain!
				if($debug){
					print "\n<!-- ERROR: No DB Connection found -->";
				}
				return false;
			}

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage(); //throw $e;
    }
}
global $pdo;
// get a db connection
if($pdo=PDOConnect())
{
	//print "\n<!-- connected to DB via PDO -->";
	$pdoRO=$pdo;	// PDO connection for Read-Only
}
else
{
	//print "\n<!-- error connecting to db over pdo -->";
}
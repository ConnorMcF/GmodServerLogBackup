<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require('dbinit.php');
$data = $_GET;

if(!isset($data["server"])) {
  die("Missing server name!");
} else {
  $server = htmlentities($data["server"]);
}
/*
if(!isset($data["value"])) {
  die("Missing log value!");
} else {
  $value = htmlentities($data["value"]);
}
*/
$time = time();
$handle = file_get_contents("ftp://".$ftpuser.":".$ftppass."@".$ftphost."/".$ftppath);
file_put_contents("data/".$time.".log",$handle);
// fclose($handle);


$sql = "INSERT INTO logs (server,value) VALUES ('".$server."','".$time."')";

if ($conn->query($sql) === TRUE) {
    echo "true";
} else {
    echo "MySQL Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

<?php
session_start();
$servername="localhost";
$Username="draftdai_dbuser";
$Password="draftdaily!@#";
$dbname="draftdai_draftdailydb";

$conn=mysqli_connect($servername,$Username,$Password,$dbname);
if(!$conn){
	echo "connection failed";
}

//define('HOSTNAME','SuportSystem');
?>
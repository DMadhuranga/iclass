<?php
try {
$dbh = new PDO('mysql:host=localhost;dbname=iclass', 'root', '1010');
}catch(PDOException $e){
	die("Connection error");
}
if(!$dbh){
	die("Connection error");
}
?>
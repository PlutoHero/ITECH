<?php 
include("dbConnect.php");
$name = $_GET['ward_name'];

$stmt = $db->prepare("INSERT INTO ward (name) values (?)");
$stmt->bindValue(1, $name);

$stmt->execute();

echo "The Ward ".$name." has been added";
?>

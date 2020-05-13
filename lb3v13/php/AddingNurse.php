
<?php 
include("dbConnect.php");

$name = $_GET['name'];
$department = $_GET['department'];
$shift = $_GET['shift'];
$date = date("Y-m-d");

$stmt = $db->prepare("INSERT INTO nurse (name, date, department, shift) values (?,?,?,?)");
$stmt->bindValue(1, $name);
$stmt->bindValue(2, $date);
$stmt->bindValue(3, $department);
$stmt->bindValue(4, $shift);

$stmt->execute();
echo "The Nurse ".$name." has been added";
?>

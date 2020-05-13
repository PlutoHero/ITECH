<?php 
include("dbConnect.php");

$wardName = $_GET['wardName'];
$nurseName = $_GET['nurseName'];

$stmt = $db->prepare("Insert into `nurse_ward`values
(
(Select `id_nurse` from `nurse` where `name`= ?),
(Select `id_ward` from `ward` where `name`= ?)
)");
$stmt->bindValue(1, $nurseName);
$stmt->bindValue(2, $wardName);
$stmt->execute();

echo "Appointment to the ".$wardName." has been added"
?>

<?php 
include("dbConnect.php");

$shift = $_GET['shift'];

$stmt = $db->prepare("SELECT * from `nurse` where `shift` = ?");

$stmt->execute(array($shift));

$result = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push ($result, $row['name']);
}
echo json_encode($result);
?>
<?php 
include("dbConnect.php");

$name = $_GET['name'];

$stmt = $db->prepare("SELECT `name` from `WARD` where `ID_WARD` in (select `FID_WARD` from `NURSE_WARD` where `FID_NURSE` = (SELECT `ID_NURSE` from `NURSE` WHERE `name` = ?))");
$stmt->execute(array($name));

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td style = 'border: 1px solid'>".$row['name']."</td></tr>";}
?>
<?php 
include("dbConnect.php");

$name = $_GET['name'];

$stmt = $db->prepare("SELECT `name` from `WARD` where `ID_WARD` in (select `FID_WARD` from `NURSE_WARD` where `FID_NURSE` in (SELECT `ID_NURSE` from `NURSE` WHERE `name` = ?))");
$stmt->bindValue(1, $name);
$stmt->execute();

print "<table border='1'><tr><caption> WARDS with $name <br></caption><th> WARDS </th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print "<tr><td>$row[name]</td></tr>";
}
?>
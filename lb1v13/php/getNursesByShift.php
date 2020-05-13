<?php 
include("dbConnect.php");

$shift = $_GET['shift'];

$stmt = $db->prepare("SELECT * from `nurse` where `shift` = ?");
$stmt->bindValue(1, $shift);
$stmt->execute();

print "<table border='1'><tr><caption>Nurses that works on the $shift shift <br></caption><th> Nurses </th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print "<tr><td>$row[name]</td></tr>";
}
?>
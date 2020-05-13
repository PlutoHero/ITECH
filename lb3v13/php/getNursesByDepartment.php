<?php 
header("Content-Type: text/xml");
header("Cache-Control: no-cache, must-revalidate");

include("dbConnect.php");

$department = $_GET['name'];

$stmt = $db->prepare("SELECT `name` from `nurse` where `department` = '$department'");
$stmt->execute();

echo "<?xml version='1.0' encoding='utf-8'?>";
echo "<Nurses>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print "<nurse><name>".$row['name']."</name></nurse>";
}
echo "</Nurses>";

?>
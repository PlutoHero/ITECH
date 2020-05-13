<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Appointment</title>
</head>
<body>
<?php

include("../php/dbConnect.php");
$wardSql = 'SELECT Distinct `name` FROM `ward`';
$nurseSql = 'SELECT `name` FROM `nurse`';

echo '<form method="get" action= "../php/Appointment.php">';
echo "<select name='wardName'><option> Choose the ward</option>";

foreach ($db->query($wardSql) as $ward) {
    echo '<option value="'.$ward['name'].'">'.$ward['name'].'</option>';
    }
    echo "</select>";

echo "<select name='nurseName'><option> Choose the nurse </option>";

foreach($db->query($nurseSql) as $row) {
    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";
echo '<input type="submit" value="ОК"><br>';
?>
</body>
</html>

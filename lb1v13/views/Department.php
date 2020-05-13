<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Department</title>
</head>
<body>
<?php
include("../php/dbConnect.php");

$departmentSql = 'SELECT DISTINCT `department` FROM `nurse`';

echo '<form method="get" action= "../php/getNursesByDepartment.php">';

echo "<select name='name'><option> Выбрать медсестр по отделению </option>";

foreach($db->query($departmentSql) as $row) {
    echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
}

echo "</select>";
echo '<input type="submit" value="ОК"><br>'
?>
</body>
</html>




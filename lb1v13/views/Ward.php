<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ward</title>
</head>
<body>
<?php
include("../php/dbConnect.php");

$nurseSql = 'SELECT `name` FROM `nurse`';

echo '<form method="get" action= "../php/getWardsByNurse.php">';

echo "<select name='name'><option> Выбрать палаты по медсестре </option>";

foreach($db->query($nurseSql) as $row) {
    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
}

echo "</select>";
echo '<input type="submit" value="ОК"><br>'
?>
</body>
</html>




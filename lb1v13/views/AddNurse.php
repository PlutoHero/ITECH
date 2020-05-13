<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AddNurse</title>
</head>
<body>
<?php
include("../php/dbConnect.php");

$departmentSql = 'SELECT DISTINCT `department` FROM `nurse`';
$shiftSql = 'SELECT DISTINCT `shift` FROM `nurse`';

echo '<form method="get" action= "../php/AddingNurse.php">';

echo "<label> Nurse's name  </label>";
echo '<input name = "name" type = "text">';

echo "  <select name='department'><option> Choose the department </option>  ";

foreach($db->query($departmentSql) as $row) {
    echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
}
echo "</select>";

echo "  <select name='shift'><option> Choose the shift </option>  ";

    foreach ($db->query($shiftSql) as $shift) {
        echo '<option value="'.$shift['shift'].'">'.$shift['shift'].'</option>';
    }
    echo "</select>";

echo '<input type="submit" value="ОК"><br>'
?>
</body>
</html>



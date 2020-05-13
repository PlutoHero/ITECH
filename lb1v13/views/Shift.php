<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shift</title>
</head>
<body>
<?php

include("../php/dbConnect.php");
$shiftSql = 'SELECT DISTINCT `shift` FROM `nurse`';
echo '<form method="get" action= "../php/getNursesByShift.php">';

echo "<select name='shift'><option> Выберите нужную смену</option>";

    foreach ($db->query($shiftSql) as $shift) {
        echo '<option value="'.$shift['shift'].'">'.$shift['shift'].'</option>';
    }
    echo "</select>";
echo '<input type="submit" value="ОК"><br>'
?>
</body>
</html>




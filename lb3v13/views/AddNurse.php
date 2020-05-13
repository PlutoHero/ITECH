<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AddNurse</title>
  <script>
const ajax = new XMLHttpRequest();

function get(){
    let name = document.getElementById("name").value;
    let department = document.getElementById("department").value;
    let shift = document.getElementById("shift").value;
    ajax.onreadystatechange = update;
    ajax.open("GET", "../php/AddingNurse.php?name="+ name + "&department=" + department + "&shift=" + shift);
    
    ajax.send(null);
}

  function update(){
    if(ajax.readyState === 4){
      if(ajax.status === 200){
        var text = document.getElementById('text');
        text.innerHTML = ajax.responseText;
      }
    }
  }
</script>
</head>
<body>
<?php
include("../php/dbConnect.php");

$departmentSql = 'SELECT DISTINCT `department` FROM `nurse`';
$shiftSql = 'SELECT DISTINCT `shift` FROM `nurse`';

echo '<form method="get">';

echo "<label> Nurse's name  </label>";
echo '<input id = "name" type = "text">';

echo "  <select id ='department'><option> Choose the department </option>  ";

foreach($db->query($departmentSql) as $row) {
    echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
}
echo "</select>";

echo "  <select id ='shift'><option> Choose the shift </option>  ";

    foreach ($db->query($shiftSql) as $shift) {
        echo '<option value="'.$shift['shift'].'">'.$shift['shift'].'</option>';
    }
    echo "</select>";

echo '<input type="button" onclick = "get()" value="ОК"><br>'
?>
<span id = "text"></span>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Appointment</title>
  <script>
const ajax = new XMLHttpRequest();

function get(){
    let wardname = document.getElementById("wardName").value;
    let nursename = document.getElementById("nurseName").value;

    ajax.onreadystatechange = update;
    ajax.open("GET", "../php/Appointment.php?wardname="+ wardname + "&nursename=" + nursename);
    
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
$wardSql = 'SELECT Distinct `name` FROM `ward`';
$nurseSql = 'SELECT `name` FROM `nurse`';

echo '<form method="get">';
echo "<select id ='wardName'><option> Choose the ward</option>";

foreach ($db->query($wardSql) as $ward) {
    echo '<option value="'.$ward['name'].'">'.$ward['name'].'</option>';
    }
    echo "</select>";

echo "<select id ='nurseName'><option> Choose the nurse </option>";

foreach($db->query($nurseSql) as $row) {
    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";
echo '<input type="button" onclick ="get()" value="ОК"><br>';
echo '</form>';
?>
<span id = "text"></span>
</body>
</html>

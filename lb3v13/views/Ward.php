<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ward</title>
  <script>
const ajax = new XMLHttpRequest();

function get(){
    let name = document.getElementById("name").value;
    ajax.onreadystatechange = update;
    ajax.open("GET", "../php/getWardsByNurse.php?name="+ name);
    
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

$nurseSql = 'SELECT `name` FROM `nurse`';

echo '<form method="get" action= "../php/getWardsByNurse.php">';

echo "<select id ='name'><option> Выбрать палаты по медсестре </option>";

foreach($db->query($nurseSql) as $row) {
    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
}

echo "</select>";
echo '<input type="button" onclick = "get()" value="ОК"><br>';
echo '</form>';
?>
<table style="border: 1px solid"><tr><th> Ward </th></tr>
<tbody id = "text"></tbody>
</body>
</html>




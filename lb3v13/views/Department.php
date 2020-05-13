<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Department</title>
  <script>
const ajax = new XMLHttpRequest();

function get(){
    let name = document.getElementById("name").value;
    ajax.onreadystatechange = update;
    ajax.open("GET", "../php/getNursesByDepartment.php?name="+ name);
    
    ajax.send(null);
}

  function update(){
    if(ajax.readyState === 4){
      if(ajax.status === 200){
        var text = document.getElementById('text');
        var res = "";
        let nurses = ajax.responseXML.firstChild.children;
        for(var i = 0; i < nurses.length; i++){
          res += "<tr>";
          res += "<td>" + nurses[i].children[0].firstChild.nodeValue + "</td>";
          res += "<tr>";
        }
        text.innerHTML = res;
      }
    }
  }
</script>
</head>
<body>
<?php
include("../php/dbConnect.php");

$departmentSql = 'SELECT DISTINCT `department` FROM `nurse`';

echo '<form method="get">';

echo "<select id ='name'><option> Выбрать медсестр по отделению </option>";

foreach($db->query($departmentSql) as $row) {
    echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
}

echo "</select>";
echo '<input type="button" onclick = "get()" value="ОК"><br>';
echo '</form>';
?>
<table style="border: 1px solid"><tr><th> Nurses </th></tr>
<tbody id = "text"></tbody>
</body>
</html>




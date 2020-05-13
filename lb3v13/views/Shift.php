<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shift</title>
  <script>
const ajax = new XMLHttpRequest();

function get(){    
    let shift = document.getElementById("shift").value;
    ajax.onreadystatechange = update;
    ajax.open("GET", "../php/getNursesByShift.php?shift="+ shift);
    ajax.send(null);
}

  function update(){
    if(ajax.readyState === 4){
      if(ajax.status === 200){
        var text = document.getElementById('text');
        var res = ajax.responseText;
        var resHtml ="";
        res = JSON.parse(res);

        res.forEach(el =>{
         resHtml += "<tr><td style = 'border: 1px solid'>" + el +"</td></tr>"
        });
        
      text.innerHTML = resHtml;
      }
    }
  }
</script>
</head>
<body>
<?php

include("../php/dbConnect.php");
$shiftSql = 'SELECT Distinct `shift` FROM `nurse`';
echo '<form method="get">';

echo "<select id ='shift'><option> Выберите нужную смену</option>";

    foreach ($db->query($shiftSql) as $shift) {
        echo '<option value="'.$shift['shift'].'">'.$shift['shift'].'</option>';
    }
    echo "</select>";
echo '<input type="button" onclick = "get()" value="ОК"><br>';
echo '</form>';
?>
<table style="border: 1px solid"><tr><th> Nurse </th></tr>
<tbody id = "text"></tbody>
</body>
</html>




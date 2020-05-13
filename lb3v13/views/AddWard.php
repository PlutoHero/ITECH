<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AddWard</title>
  <script>
const ajax = new XMLHttpRequest();

function get(){
    let name = document.getElementById("ward_name").value;
    ajax.onreadystatechange = update;
    ajax.open("GET", "../php/AddingWard.php?ward_name="+ name);
    
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
echo '<form method="get">';

echo "<label> Name of the ward  </label>";
echo '<input id = "ward_name" type = "text">';

echo '<input type="button" onclick = "get()" value="ОК"><br>';
echo '</form>';
?>
<span id = "text"></span>
</body>
</html>



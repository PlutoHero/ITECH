<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    const xhr = new XMLHttpRequest();

    function getWards() {
        let nurse = document.getElementById("nurse").value;
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let table = document.getElementById("wardsTable");
                let result = "";
                let lastReqHtml = "";
                let lastReq = JSON.parse(localStorage.getItem("wardsByNurse"));
                let wards = JSON.parse(xhr.responseText);
                for(ward in wards){
                    result += "<tr><td style = 'border: 1px solid'>" + wards[ward] + "</td></tr>";
                }            
                table.innerHTML = result;
                if(lastReq == null){
                    lastReqHtml +="<tr><td style = 'border: 1px solid'> there are no recent reqs </td></tr>";
                    document.getElementById("wardsTablePrev").innerHTML = lastReqHtml;
                }
                else{
                    for(element in lastReq) {
                    lastReqHtml += "<tr><td style = 'border: 1px solid'>" + lastReq[element] + "</td></tr>"; 
                    }
                    document.getElementById("wardsTablePrev").innerHTML = lastReqHtml;
                }
                localStorage.setItem("wardsByNurse", xhr.responseText);
            }
        }
        xhr.open("GET", "mongo_wards_by_nurse.php?nurse=" + nurse);
        xhr.send(null);
    }
    </script>
</head>
<body>
    <select name="nurse" id="nurse">
    <?php
        require_once __DIR__ . "/vendor/autoload.php";
        $collection = (new MongoDB\Client)->dbforlab->duties;
        $cursor = $collection->find();
        $nurses = [];
        foreach ($cursor as $document) {
            foreach ($document['nurses'] as $nurse) {
                array_push($nurses, $nurse);
            }
        }
        $nurses = array_unique($nurses);
        foreach ($nurses as $nurse) {
            echo "<option value='$nurse'>$nurse</option>";
        }
    ?>
    </select>
    <input type="button" value="Select" onclick="getWards();">
    <br><table>
        <thead>
            <th style = 'border: 1px solid'>WardName</th>
        </thead>
        <tbody id="wardsTable"></tbody>
    </table>
    <br><span>Previous Response</span>
    <br><table>
        <thead>
            <th style = 'border: 1px solid'>WardName</th>
        </thead>
        <tbody id="wardsTablePrev"></tbody>
    </table>
</body>
</html>
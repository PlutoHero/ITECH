<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    const xhr = new XMLHttpRequest();

    function getNurses() {
        let department = document.getElementById("department").value;
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let table = document.getElementById("nursesTable");
                let result = "";
                let lastReqHtml = "";
                let lastReq = JSON.parse(localStorage.getItem("nursesByDepartment"));
                let nurses = JSON.parse(xhr.responseText);
                nurses.forEach(element => {
                   result += "<tr><td style = 'border: 1px solid'>" + element + "</td></tr>"; 
                });
                table.innerHTML = result;
                if(lastReq == null){
                    lastReqHtml +="<tr><td style = 'border: 1px solid'> there are no recent reqs </td></tr>";
                    document.getElementById("nursesTablePrev").innerHTML = lastReqHtml;
                }
                else{
                    lastReq.forEach(element => {
                    lastReqHtml += "<tr><td style = 'border: 1px solid'>" + element + "</td></tr>"; 
                    });
                    document.getElementById("nursesTablePrev").innerHTML = lastReqHtml;
                }
                localStorage.setItem("nursesByDepartment", xhr.responseText);
            }
        }
        xhr.open("GET", "mongo_nurses_by_department.php?department=" + department);
        xhr.send(null);
    }
    </script>
</head>
<body>
    <select name="department" id="department">
    <?php
        require_once __DIR__ . "/vendor/autoload.php";
        $collection = (new MongoDB\Client)->dbforlab->duties;
        $cursor = $collection->find();
        $departments = [];
        foreach ($cursor as $document) {
                array_push($departments, $document['department']);
        }
        $departments = array_unique($departments);
        foreach ($departments as $department) {
            echo "<option value='$department'>$department</option>";
        }
    ?>
    </select>
    <input type="button" value="Select" onclick="getNurses();">
    <br><table>
        <thead>
            <th style = 'border: 1px solid'>Nurses</th>
        </thead>
        <tbody id="nursesTable"></tbody>
    </table>
    <br><span>Previous Response</span>
    <br><table>
        <thead>
            <th style = 'border: 1px solid'>Nurses</th>
        </thead>
        <tbody id="nursesTablePrev"></tbody>
    </table>
</body>
</html>
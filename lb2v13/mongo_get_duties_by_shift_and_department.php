<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    const xhr = new XMLHttpRequest();

    function getDuties() {
        let shift = document.getElementById("shift").value;
        let department = document.getElementById("department").value;
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let table = document.getElementById("dutiesTable");
                let result = "";
                let lastReqHtml = "";
                let duties = JSON.parse(xhr.responseText);
                let lastReq = JSON.parse(localStorage.getItem("dutiesByShiftAndDepartment"));
                for (let i = 0; i < duties.length; i++) {
                        result += "<tr>";
                        result += "<td style = 'border: 1px solid'>" + duties[i].shift + "</td>"; 
                        result += "<td style = 'border: 1px solid'>" + duties[i].date + "</td>";
                        result += "<td style = 'border: 1px solid'>" + duties[i].nurse + "</td>";
                        result += "<td style = 'border: 1px solid'>" + duties[i].department + "</td>";
                        result += "<td style = 'border: 1px solid'>" + duties[i].ward + "</td>";
                        result += "</tr>";                  
                    }
                table.innerHTML = result;
                if(lastReq == null){
                    lastReqHtml +="<tr><td style = 'border: 1px solid'> there are no recent reqs </td></tr>";
                    document.getElementById("dutiesTablePrev").innerHTML = lastReqHtml;
                }
                else{
                    for (let i = 0; i < lastReq.length; i++) {
                        lastReqHtml += "<tr>";
                        lastReqHtml += "<td style = 'border: 1px solid'>" + lastReq[i].shift + "</td>"; 
                        lastReqHtml += "<td style = 'border: 1px solid'>" + lastReq[i].date + "</td>";
                        lastReqHtml += "<td style = 'border: 1px solid'>" + lastReq[i].nurse + "</td>";
                        lastReqHtml += "<td style = 'border: 1px solid'>" + lastReq[i].department + "</td>";
                        lastReqHtml += "<td style = 'border: 1px solid'>" + lastReq[i].ward + "</td>";
                        lastReqHtml += "</tr>";                  
                    }
                    document.getElementById("dutiesTablePrev").innerHTML = lastReqHtml;
                }
                localStorage.setItem("dutiesByShiftAndDepartment", xhr.responseText);
            }
        }
        xhr.open("GET", "mongo_duties_by_shift_and_department.php?shift=" + shift + "&department=" + department);
        xhr.send(null);
    }
    </script>
</head>
<body>
    <span>Shift</span><br>
    <select name="shift" id="shift">
    <?php
        require_once __DIR__ . "/vendor/autoload.php";
        $collection = (new MongoDB\Client)->dbforlab->duties;
        $cursor = $collection->find();
        $shifts = [];
        foreach ($cursor as $document) {
                array_push($shifts, $document['shift']);
        }
        $shifts = array_unique($shifts);
        foreach ($shifts as $shift) {
            echo "<option value='$shift'>$shift</option>";
        }
    ?>
    </select><br>
    <span>Department</span><br>
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
    <input type="button" value="Select" onclick="getDuties();">
    <br><table>
        <thead>
            <th style = 'border: 1px solid'>Shift</th>
            <th style = 'border: 1px solid'>Date</th>
            <th style = 'border: 1px solid'>Nurse</th>
            <th style = 'border: 1px solid'>Department</th>
            <th style = 'border: 1px solid'>Ward</th>
        </thead>
        <tbody id="dutiesTable"></tbody>
    </table>
    <br><span>Previous Response</span>
    <br><table>
        <thead>
            <th style = 'border: 1px solid'>Shift</th>
            <th style = 'border: 1px solid'>Date</th>
            <th style = 'border: 1px solid'>Nurse</th>
            <th style = 'border: 1px solid'>Department</th>
            <th style = 'border: 1px solid'>Ward</th>
        </thead>
        <tbody id="dutiesTablePrev"></tbody>
    </table>
</body>
</html>
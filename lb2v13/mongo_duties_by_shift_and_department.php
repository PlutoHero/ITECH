<?php
    require_once __DIR__ . "/vendor/autoload.php";
    $collection = (new MongoDB\Client)->dbforlab->duties;

    $shift = $_GET['shift'];
    $department = $_GET['department'];

    $cursor = $collection->find(array('shift' => $shift, 'department' => $department));
    $duties = [];
    foreach ($cursor as $document) {
        $date = $document['date'];
        foreach ($document['nurses'] as $key => $value) {
            $nurse = $value;
            $ward = $document['wards'][$key];
            $duty = ["shift" => $shift, "date" => $date, "nurse" => $nurse, "department" => $department, "ward" => $ward];
            array_push($duties, $duty);
        }
    }
    echo json_encode($duties);
?>
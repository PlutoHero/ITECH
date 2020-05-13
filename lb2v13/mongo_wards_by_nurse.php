<?php
    require_once __DIR__ . "/vendor/autoload.php";
    $collection = (new MongoDB\Client)->dbforlab->duties;

    $nurse = $_GET['nurse'];

    $cursor = $collection->find();
    $wards = [];
    foreach ($cursor as $document) {
        foreach ($document['nurses'] as $key => $value) {
            if ($value == $nurse) {
                array_push($wards, $document['wards'][$key]);
            }
        }
    }
    $wards = array_unique($wards);
    echo json_encode($wards);
?>
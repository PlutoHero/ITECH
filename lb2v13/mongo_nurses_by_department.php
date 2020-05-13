<?php
    require_once __DIR__ . "/vendor/autoload.php";
    $collection = (new MongoDB\Client)->dbforlab->duties;

    $department = $_GET['department'];

    $cursor = $collection->find(array('department' => $department));
    $nurses = [];
    foreach ($cursor as $document) {
        foreach ($document['nurses'] as $nurse) {
            array_push($nurses, $nurse);
        }
    }
    $nurses = array_unique($nurses);
    echo json_encode($nurses);
?>
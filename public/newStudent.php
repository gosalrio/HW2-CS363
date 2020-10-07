<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: POST');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('Student.php');
    $data = json_decode(file_get_contents("php://input"), true);

    $file = fopen('students.txt', "a");

    $studentRAW = "";

    $i = 0;
    foreach ($data as $key => $value) {
        $studentRAW = $studentRAW . $value;
        if ($i != (sizeof($data) - 1)) {
            $studentRAW = $studentRAW . ", ";
        }
        if ($i == sizeof($data)) {
            $studentRAW = $studentRAW . "\n";
        }
        $i++;
    }

    fwrite($file, $studentRAW);

    fclose($file);
    die(json_encode(true));
}

die("404 Not Found");

<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: POST');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $file = fopen('students.txt', "a");
    fwrite($file, rand(10000000, 99999999) . ", "); //Insert random id no.

    $studentRAW = "";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($value == "" || $value == null) {
            throw new Exception("null value detected");
        }

        $studentRAW = $studentRAW . $value;
        if ($i != (sizeof($data) - 1)) {
            $studentRAW = $studentRAW . ", ";
        }
        if ($i == sizeof($data) - 1) {
            $studentRAW = $studentRAW . "\n";
        }
        $i++;
    }

    fwrite($file, $studentRAW);

    fclose($file);
    die(json_encode(true));
}

die("404 Not Found");

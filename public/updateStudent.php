<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: PATCH');

if ($_SERVER['REQUEST_METHOD'] === "PATCH") {
    require('Student.php'); //need student class
    $students = json_decode(file_get_contents("php://input"), true)['students'];

    //Convert streamed data into Student Object
    $studentsRAW = "";
    foreach ($students as $student) {
        $i = 0;
        foreach ($student as $key => $value) {
            $studentsRAW = $studentsRAW . $value;
            if ($i != sizeof($student) - 1) {
                $studentsRAW = $studentsRAW . ", ";
            }
            $i++;
        }
        $studentsRAW = $studentsRAW . "\n";
    }

    $file = fopen('students.txt', "w");
    fwrite($file, $studentsRAW);
    fclose($file);
}

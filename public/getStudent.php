<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: GET');

require('Student.php'); //need student class

$data_id = $_GET['id'];

$file = fopen('students.txt', "r");
$searchedStudents = [];

while (!feof($file)) {
    $studentRAW = fgets($file); // apparently only gets until first line break '\n'

    if ($studentRAW == "") {
        break;
    }

    $studentArr = explode(", ", $studentRAW); // split()

    //Clean up to remove any extra tags
    foreach ($studentArr as $index => $attribute) {
        $studentArr[$index] = trim($attribute);
    }

    //Instantiate Student Object
    $student = new Student(
        $studentArr[0],
        $studentArr[1],
        $studentArr[2],
        $studentArr[3],
        $studentArr[4],
        $studentArr[5],
        $studentArr[6],
        $studentArr[7]
    );

    if ($student->id == $data_id) {
        $searchedStudents[] = $student;
    }
}

die(json_encode($searchedStudents));

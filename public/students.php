<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: POST');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('Student.php');

    $students = [];
    $file = fopen('students.txt', 'r');

    while (!feof($file)) {
        $studentRAW = fgets($file); // apparently only gets until first line break '\n'
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

        //Add student to list of students
        $students[] = $student;
    }

    fclose($file);

    die(json_encode($students));
}

die("404 Not Found");

<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: POST');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require('Student.php'); //need student class
    $data_id = json_decode(file_get_contents("php://input"), true)['id'];

    $file = fopen('students.txt', "r");

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

        //Add student to list of students
        $students[] = $student;
    }

    for ($i = 0; $i < sizeof($students); $i++) {
        if ($students[$i]->id == $data_id) {
            unset($students[$i]);
        }
    }

    fclose($file);

    //STEP 2: Rewrite the whole file (this is so inefficient)
    $rewrittenFile = fopen("students.txt", 'w');

    foreach ($students as $student) { // if this operation fails to write RIP all data
        $j = 0;
        foreach ($student as $key => $value) {
            fwrite($rewrittenFile, $value);
            if ($j != sizeof((array)$student) - 1) {
                fwrite($rewrittenFile, ", ");
            }
            $j++;
        }
        fwrite($rewrittenFile, "\n");
    }

    fclose($rewrittenFile);
    die(json_encode(true));
}

die("404 Not Found");

<?php

class Student
{
    public $id, $name, $ssn, $major, $age, $sex, $address, $gpa;

    function __construct($id, $name, $ssn, $major, $age, $sex, $address, $gpa)
    {
        $this->id = $id;
        $this->name = $name;
        $this->ssn = $ssn;
        $this->major = $major;
        $this->age = $age;
        $this->sex = $sex;
        $this->address = $address;
        $this->gpa = $gpa;
    }
}

<?php
class Student {
    public $name;
    public $email;
    public $course;

    public function __construct($name, $email, $course) {
        $this->name = $name;
        $this->email = $email;
        $this->course = $course;
    }

    public function displayInfo() {
        return "Student Name: " . $this->name . " | Email: " . $this->email . " | Course: " . $this->course;
    }

    public function getCourse() {
        return $this->course;
    }
}
?>
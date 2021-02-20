<?php

include "dbconnection.php";

class UserHome{

    public static function getNewCourses()
    {
        global $conn;
        $courses=$conn->prepare("SELECT * FROM courses LIMIT 6");
        $courses->execute();
        return $courses;
    }
}
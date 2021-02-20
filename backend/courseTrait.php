<?php

trait CourseTrait{
   
    /**
     *  Get Course Request ID
     * return Course Request data
     */
    public static function checkCourseRequest($courseID){
        global $conn;
        $courseRequest=$conn->prepare("SELECT * FROM requests WHERE course_id=? LIMIT 1");
        $courseRequest->execute([$courseID]);
        return $courseRequest;

    }
}
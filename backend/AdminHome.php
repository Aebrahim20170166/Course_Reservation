<?php
include "dbconnection.php";

class AdminHome
{
   public static function getCounters()
   {
       global $conn;
       $coursesCounters=$conn->prepare("SELECT COUNT('id') FROM courses");
       $coursesCounters->execute();

       $requestsCounters=$conn->prepare("SELECT COUNT('id') FROM requests");
       $requestsCounters->execute();

       $data=['coursesCounter'=>$coursesCounters->fetchColumn(),'requestsCounter'=>$requestsCounters->fetchColumn ()];
       return $data;

   }
}
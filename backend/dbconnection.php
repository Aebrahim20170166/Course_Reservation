<?php

$user="root";
$password="";

$driver="mysql:host=localhost;dbname=eraasoft_workshop";
try{
    $conn=new PDO($driver,$user,$password);

}catch(PDOException $e)
{
    echo "Error :".$e;
}
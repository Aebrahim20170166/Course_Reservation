<?php
include 'dbconnection.php';
include 'honeyBotTrait.php';
class aboutUS{

    use HoneyBot;
    /**
     * get about data
     * insert into database 
     * create session 
     * header.
     */
    public static function addAboutUS()
    {
        global $conn;
        $location=$_POST['location'];
        $phone_number=$_POST['phone_number'];
        $email=$_POST['email'];
        $about=$conn->prepare("INSERT INTO about(location,phone,email) VALUES(?,?,?)");
        if($about->execute([$location,$phone_number,$email]))
        {
            session_start();
            $_SESSION['success']='About added successfully';
            header("location:../admin/pages/tables/AboutUs.php");
        }

    }
    /**
     * return all about from the database.
     */
    public static function getAllAboutUs()
    {
        global $conn;
        $about=$conn->prepare("SELECT * FROM about");
        $about->execute();
        return $about;
    }
    /**
     * get the id of particular about 
     * check the honeyBot
     * then deltet it.
     * create session 
     * header
     */
    public static function deleteAbout()
    {
        global $conn;
        $id=$_POST['id'];
        $scriptData=$_POST['script'];
        $checkHBot=checkHoneyBot($scriptData);
        if($checkHBot==0)
        {
            session_start();
            $_SESSION['success']='You are an ugly user';
            header("location:../admin/pages/tables/AboutUs.php");
        }
        $about=$conn->prepare("DELETE FROM about WHERE id=?");
        if($about->execute([$id]))
        {
            session_start();
            $_SESSION['success']='About deleted successfully';
            header("location:../admin/pages/tables/AboutUs.php");
        }

    }
    /**
     * get the id of about 
     * and return the data of this about
     */
    public static function getAbouData($id)
    {
        global $conn;
        $about=$conn->prepare("SELECT * FROM about WHERE id=? LIMIT 1");
        $about->execute([$id]);
        return $about->fetch();
    }
    /**
     * get the new data
     * check the honeyBot
     * update the data 
     * create session
     * header.
     */
    public static function updateAbout()
    {
        global $conn;
        $id=$_POST['id'];
        $location=$_POST['location'];
        $phone_number=$_POST['phone_number'];
        $email=$_POST['email'];
        $scriptData=$_POST['script'];
        $checkHBot=checkHoneyBot($scriptData);
        if($checkHBot==0)
        {
            session_start();
            $_SESSION['success']='You are an ugly user';
            header("location:../admin/pages/tables/AboutUs.php");
        }
        $about=$conn->prepare("UPDATE about SET location=?,phone=?,email=? WHERE id=?");
        if($about->execute([$location,$phone_number,$email,$id]))
        {
            session_start();
            $_SESSION['success']='About updated successfully';
            header("location:../admin/pages/tables/AboutUs.php");
        }

    }
}

if(isset($_POST['add_submit']))
{
    aboutUS::addAboutUS();
}

if(isset($_POST['submit_delete']))
{
    aboutUS::deleteAbout();
}
if(isset($_POST['update_submit']))
{
    aboutUS::updateAbout();
}
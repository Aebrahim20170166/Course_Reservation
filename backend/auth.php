<?php
include 'dbconnection.php';

class Auth{

    public static function login()
    {
        global $conn;
        $email=$_POST['email'];
        $password=$_POST['password'];
        $newPassword=SHA1($password);
        //echo $newPassword;
        $auth=$conn->prepare("SELECT role FROM users WHERE email=? AND password=? LIMIT 1");
        $auth->execute([$email,$newPassword]);
        $authData=$auth->fetchObject();
        session_start();
        if(empty($authData))
        {
            $_SESSION['error']="Email Or password is invalid";
            header("location:../admin/login.php");
        }
        else{
            $_SESSION['role']=$authData->role;
            header("location:../admin/index.php");
        }

    }
}
if(isset($_POST['login']))
{
    Auth::login();
}
<?php
include 'dbconnection.php';
include 'userTrait.php';
class Admin{
 
    use userTrait;
    public static function addAdmin()
    {
       global $conn;
       $name=$_POST['name'];
       $email=$_POST['email'];
       $password=$_POST['password'];
       $confirm_password=$_POST['confirm_password'];
       $checkPass=self::checkPasswords($password,$confirm_password);
       if($checkPass==0)
       {
            session_start();
            $_SESSION['error']='Two passwords are not match';
            header("location:../admin/pages/forms/add-admin.php");
            die();
       }
       $new_password=SHA1($password);
       $admin=$conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");
       if($admin->execute([$name,$email,$new_password,0]))
       {
        session_start();
        $_SESSION['success']='Admin added successfully';
        header("location:../admin/pages/tables/Admins.php");
       }
    }
    public static function getAllAdmins()
    {
        global $conn;
        $admin=$conn->prepare("SELECT * FROM users");
        $admin->execute();
        return $admin;
    }
    public static function deleteAdmin()
    {
        global $conn;
        $id=$_POST['admin_id'];
        $admin=$conn->prepare("DELETE FROM users WHERE id=?");
        if($admin->execute([$id]))
        {
            session_start();
            $_SESSION['success']='Admin deleted successfully';
            header("location:../admin/pages/tables/Admins.php");
        }
    }
    public static function getAdmin($id)
    {
        global $conn;
        $admin=$conn->prepare("SELECT * FROM users WHERE id=?");
        $admin->execute([$id]);
        return $admin->fetch();
    }
    public static function updateAdmin()
    {
       global $conn;
       $id=$_POST['id'];
       $name=$_POST['name'];
       $email=$_POST['email'];
       $password=$_POST['password'];
       $new_password=password_hash($password,PASSWORD_DEFAULT);
       $admin=$conn->prepare("UPDATE users SET name=?,email=?,password=?,role=? WHERE id=?");
       if($admin->execute([$name,$email,$new_password,0,$id]))
       {
        session_start();
        $_SESSION['success']='Admin Updated successfully';
        header("location:../admin/pages/tables/Admins.php");
       }
    }

}

if(isset($_POST['add_submit']))
{
    Admin::addAdmin();
}
if(isset($_POST['submit_delete'])){
    Admin::deleteAdmin();
}
if(isset($_POST['update_submit']))
{
    Admin::updateAdmin();
}
<?php
include 'dbconnection.php';
include 'imageTrait.php';

class Sliders{
    
    use ImageTrait;

    public static function addSlider(){
        global $conn;
        $image_name=$_FILES['image']['name'];
        $image_type=$_FILES['image']['type'];
        $image_temp_name=$_FILES['image']['tmp_name'];
        $image_size=$_FILES['image']['size'];
        
        $scriptData=$_POST['script'];
        checkHoneyBot($scriptData);
        
        $imageLink=dirname(__FILE__).'/../admin/pages/upload/';
        $imageExt=Sliders::checkImageExtensions($image_type);
        if($imageExt==0)
        {
            session_start();
            $_SESSION['error']="You must upload correct file";
            header("location:../admin/pages/forms/add-course.php");
            die();

        }

        $avatarName=Sliders::checkImageExist(time().'_'. $image_name);
       
        $checkImageSize=Sliders::checkImageSize($image_size);
        if($checkImageSize==0)
        {
            session_start();
            $_SESSION['error']="large file !!";
            header("location:../admin/pages/forms/add-course.php");
            die();
        }
        $slider=$conn->prepare("INSERT INTO sliders(image_name) VALUES(?)");
        if($slider->execute([$avatarName]))
        {
            if(move_uploaded_file($image_temp_name,$imageLink. $avatarName))
            {
                session_start();
                $_SESSION['success']="Slider added successfully";
                header("location:../admin/pages/forms/add-slider.php");
                die();
            }
            
        }
    }
    public static function getSliders(){
        global $conn;
        $sliders=$conn->prepare("SELECT * FROM sliders");
        $sliders->execute();
        return $sliders;
    }
    public static function deleteSlider(){
        global $conn;
        $slider_id=$_POST['slider_id'];
        $slider_name=$_POST['slider_name'];
        $scriptData=$_POST['script'];
        checkHoneyBot($scriptData);
        $path="../admin/pages/upload/".$slider_name;
        $sliders=$conn->prepare("DELETE FROM sliders WHERE id=?");
        if($sliders->execute([$slider_id]))
        {
            if(file_exists($path))
            {
                unlink($path);
                session_start();
                $_SESSION['success']="slider deleted successfully";
                header("location:../admin/pages/tables/Sliders.php");
                die();
            }
        }
    }
    public static function getSliderData($id){
        global $conn;
        $slider=$conn->prepare("SELECT * FROM sliders WHERE id=?");
        $slider->execute([$id]);
        return $slider->fetch(); 
    }
    public static function updateSlider(){
        global $conn;
     $sliderID=$_POST['slider_id'];
     $oldImage=$_POST['old_image'];
     $image_name=$_FILES['image']['name'];
     $image_type=$_FILES['image']['type'];
     $image_temp_name=$_FILES['image']['tmp_name'];
     $image_size=$_FILES['image']['size'];
     
     $scriptData=$_POST['script'];
     checkHoneyBot($scriptData);

     $imageLink=dirname(__FILE__).'/../admin/pages/upload/';
     
     $imageExt=Sliders::checkImageExtensions($image_type);
     if($imageExt==0)
     {
         session_start();
         $_SESSION['error']="You must upload correct file";
         header("location:../admin/pages/forms/updateSlider.phpid=".$sliderID);
         die();

     }

     $avatarName=time().'_'.$image_name;
     
     $checkImageSize=Sliders::checkImageSize($image_size);
     if($checkImageSize==0)
     {
        session_start();
        $_SESSION['error']="large file !!";
        header("location:../admin/pages/forms/update-slider.php");
        die();
     }
     
     $path="../admin/pages/upload/".$oldImage;
    unlink($path);
    $slider=$conn->prepare("UPDATE sliders set image_name=? WHERE id=?");
    if($slider->execute([$avatarName,$sliderID]))
    {
        if(move_uploaded_file($image_temp_name,$imageLink.$avatarName)){
            session_start();
            $_SESSION['success']="Slider Updated successfully";
            header("location:../admin/pages/tables/Sliders.php");
            die();
        }
        
    }
     
    }
}

if(isset($_POST['add_submit']))
{
    Sliders::addSlider();
}
if(isset($_POST['delete_submit']))
{
    Sliders::deleteSlider();
}
if(isset($_POST['update_submit'])){
    Sliders::updateSlider();
}
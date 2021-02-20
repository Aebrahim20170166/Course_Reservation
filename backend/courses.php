<?php
include 'dbconnection.php';
include 'imageTrait.php';
include 'honeyBotTrait.php';
include 'courseTrait.php';
class Courses{

    use ImageTrait;
    use HoneyBot;
    use CourseTrait;
    /**
     * get data .
     * check script data.
     * validate image .
     * then insert in database,
     * create session to message.
     * redirect using header function.
     */
    public static function addCourse(){
     global $conn;
     $title=$_POST['title'];
     $price=$_POST['price'];
     $body=$_POST['body'];
     $category_id=$_POST['category_id'];
     $scriptTime=$_POST['script'];
     $image_name=$_FILES['image']['name'];
     $image_type=$_FILES['image']['type'];
     $image_temp_name=$_FILES['image']['tmp_name'];
     $image_size=$_FILES['image']['size'];
    
     $imageLink=dirname(__FILE__).'/../admin/pages/upload/';
     $imageExt=Courses::checkImageExtensions($image_type);
     if($imageExt==0)
     {
         session_start();
         $_SESSION['error']="You must upload correct file";
         header("location:../admin/pages/forms/add-course.php");
         die();

     }

     $avatarName=Courses::checkImageExist(time().'_'. $image_name);

     $checkImageSize=Courses::checkImageSize($image_size);
     if($checkImageSize==0)
     {
        session_start();
        $_SESSION['error']="large file !!";
        header("location:../admin/pages/forms/add-course.php");
        die();
     }

     if(Courses::CheckWhoFillForm($scriptTime)==0){
        session_start();
        $_SESSION['error']='You are an ugly user!!';
        header("location:../admin/pages/tables/Courses.php");
        die();
     }

            
     $course=$conn->prepare("INSERT INTO courses(title,price,image_name,body,catogry_id) VALUES(?,?,?,?,?)");
     if($course->execute([$title,$price,$avatarName, $body,$category_id]))
     {
        if(move_uploaded_file($image_temp_name,$imageLink. $avatarName))
        {
            session_start();
            $_SESSION['success']="Course added successfully";
            header("location:../admin/pages/forms/add-course.php");
            die();
        }
        
     }
    
    }
    /**End of add course function */
    
    /**
     * get all courses 
     * then return them
     */
    public static function getCourses()
    {
        global $conn;
        $courses=$conn->prepare("SELECT co.id,co.title,co.price,co.image_name,co.body,ca.name FROM courses AS co,categories AS ca
        WHERE co.catogry_id=ca.id");
        $courses->execute();
        return $courses;
    }
    /**
     * get the course id
     * check if have requests or not
     * delete the course ant it's image
     * create message 
     * then create session
     * header
     */

    public static function deleteCourse()
    {
        global $conn;
        
        $course_id=$_POST['course_id'];
        $course_image=$_POST['course_image'];
        
        $scriptData=$_POST['script'];
        $checkHBot=checkHoneyBot($scriptData);
        if($checkHBot==0)
        {
            session_start();
            $_SESSION['success']='You are an ugly user';
            header("location:../admin/pages/tables/Courses.php");
        }

        $path="../admin/pages/upload/".$course_image;
        
        $Requests=Courses::checkCourseRequest($course_id);
        if(!empty($Requests->fetchColumn())){
            session_start();
            $_SESSION['error']='Cannot delete this course, it have requests ';
            header("location:../admin/pages/tables/Courses.php");
        }
        $course=$conn->prepare("DELETE FROM courses WHERE id=?");
        if($course->execute([$course_id]))
        {
            unlink($path);
            session_start();
            $_SESSION['success']='Course deleted successfully';
            header("location:../admin/pages/tables/Courses.php");
        }
        
    }

    /**
     * get the course id.
     * then get the data of this course.
     * return the course data.
     */
    public static function getCourseData($id){
        global $conn;
        $course=$conn->prepare("SELECT co.id,co.title,co.price,co.image_name,co.body,co.catogry_id,cat.name as cat_name
        FROM courses as co INNER JOIN categories as cat on co.catogry_id=cat.id WHERE co.id=? LIMIT 1");
        $course->execute([$id]);
        return $course->fetchObject();
    }
    /**
     * get the course data.
     * check if the user choose new image or not.
     * if yes validate the new image.
     * delete the old image .
     * upload the new image and then update the the data in the database.
     * if not update the data of the course only.
     */
    public static function updateCourse(){
        global $conn;
        $course_id=$_POST['course_id'];
        $title=$_POST['title'];
        $price=$_POST['price'];
        $body=$_POST['body'];
        $category_id=$_POST['category_id'];
        $old_image=$_POST['old_image'];
        if(!empty($_FILES['image']['name'])){
            $image_name=$_FILES['image']['name'];
            $image_type=$_FILES['image']['type'];
            $image_temp_name=$_FILES['image']['tmp_name'];
            $image_size=$_FILES['image']['size'];

            $imageExt=Courses::checkImageExtensions($image_type);
            if($imageExt==0)
            {
                if($imageExt==0)
                {
                    session_start();
                    $_SESSION['error']="You must upload correct file";
                    header("location:../admin/pages/forms/add-course.php");
                    die();

                }
            }

            $avatarName=Courses::checkImageExist(time().'_'. $image_name);

            $checkImageSize=Courses::checkImageSize($image_size);
            $imageLink=dirname(__FILE__).'/../admin/pages/upload/';
            if($checkImageSize==0)
            {
                session_start();
                $_SESSION['error']="large file !!";
                header("location:../admin/pages/forms/update-course.php?id=".$course_id);
                die();
            }
            $path="../admin/pages/upload/".$old_image;
            unlink($path);
            move_uploaded_file($image_temp_name,$imageLink.$avatarName);

        }
        else{
            $avatarName=$old_image;
        }
        
        $course=$conn->prepare("UPDATE courses set title=?,price=?,image_name=?,body=?,catogry_id=? WHERE id=?");
        if($course->execute([$title,$price,$avatarName, $body,$category_id,$course_id]))
        {
                session_start();
                $_SESSION['success']="Course updated successfully";
                header("location:../admin/pages/tables/Courses.php");
                die();
            
        }

    }

    
}
if(isset($_POST['add_submit']))
{
    courses::addCourse();
}

if(isset($_POST['update_submit']))
{
    courses::updateCourse();
}

if(isset($_POST['submit_delete']))
{
    courses::deleteCourse();
}

?>
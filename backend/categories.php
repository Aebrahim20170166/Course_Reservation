<?php
 include 'dbconnection.php';
 include 'honeyBotTrait.php';
 class Category{
    
    use HoneyBot;
    /**
     * get the category name
     * insert it the database
     * session to save message 
     * header location to redirect to add-category page
     */
    public static function addCategory(){

        global $conn;
        $name = $_POST['category_name'];
        $category=$conn->prepare("INSERT INTO categories(name) VALUES(?)");
        $category->execute([$name]);
        session_start();
        $_SESSION['success']='Category added successfully';
        header('location:../admin/pages/forms/add-category.php');

    }
    /**
     * select all rows in categorues table 
     * then return it
     */
    public static function getCategories(){
        global $conn;
        $categories=$conn->prepare("SELECT * FROM categories");
        $categories->execute();
        //print_r($categories->fetch());
        //die();
        return $categories;
    }

    /**
     * get the category id.
     * get script value
     * check if the user is real user or script
     * delete the category.
     * create session to save the message.
     * then redirect to categories page using header() function.
     */
    public static function deleteCategory()
    {
        global $conn;
        $scriptData=$_POST['script'];
        if(Category::checkHoneyBot($scriptData)==0)
        {
            session_start();
            $_SESSION['error']='You are an ugly user!!';
            header("location:../admin/pages/tables/Categories.php");
            die();
        }
        $category_id=$_POST['category_id'];
        $category=$conn->prepare("DELETE FROM categories WHERE id=?");
        $category->execute([$category_id]);
        session_start();
        $_SESSION['success']='Category deleted successfully';
        header("location:../admin/pages/tables/Categories.php");
    }
    /**
     * get the id course
     * and return the data of this course
     */
    public static function getCategoryData($id){
        global $conn;
        $category=$conn->prepare("SELECT * FROM categories WHERE id=? LIMIT 1");
        $category->execute([$id]);
        return $category->fetch();
    }
    /**
     * get the id of category,new category name 
     * get the script variable that check if this is normal user or not
     * and call function that check if the user is real or not
     */
    public static function updateCategory(){
        global $conn;
        $id=$_POST['id'];
        $name=$_POST['name'];
        $scriptData=$_POST['script'];
        //echo $scriptData;
        //die();
        if(Category::checkHoneyBot($scriptData)==0)
        {
            session_start();
            $_SESSION['error']='You are an ugly user!!';
            header("location:../admin/pages/tables/Categories.php");
            die();
        }
        
        $category=$conn->prepare("UPDATE categories SET name=? WHERE id=?");
        if($category->execute([$name,$id])){
            session_start();
            $_SESSION['success']='Category updated successfully';
            header("location:../admin/pages/tables/Categories.php");
        }
    }
}

if( isset($_POST['submit_add']) ){
    Category::addCategory();
}

if( isset($_POST['submit_delete']))
{
    Category::deleteCategory();
}

if(isset($_POST['submit_update'])){
    Category::updateCategory();

}

?>
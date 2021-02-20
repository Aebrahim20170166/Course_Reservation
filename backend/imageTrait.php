<?php
trait ImageTrait{

    /**
     * check image extension
     * return 1 for true and 0 for false
     * 
     */
    public static function checkImageExtensions($imageType){
        $exts=['image/png','image/jpeg','image/jpg'];
        if(in_array($imageType,$exts)){
            return 1;
        }

        return 0;
    }
    public static function checkImageExist($imageName){
        global $conn;
        $checkImageExist=$conn->prepare("SELECT image_name FROM courses WHERE image_name=? LIMIT 1");
        $checkImageExist->execute([$imageName]);
        if(empty($checkImageExist->fetchColumn())){
            return $imageName;
        }
        $imageName=rand(1,1000000).'_'.$imageName;
        return $imageName;
            
    }
    public static function checkImageSize($imageSize){
        if($imageSize<10000000)
        {
            return 1;
        }
        return 0;
    }
}
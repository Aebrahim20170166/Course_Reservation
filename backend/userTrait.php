<?php

trait userTrait{

    public static function checkPasswords($password,$confirm_password)
    {
        if($password!=$confirm_password)
        {
            return 0;
        }
        return 1;
    } 
}
<?php
 
 trait HoneyBot{

    /**
     * get the time when the user fill the form
     * and get the time now
     * get the difference between them 
     * check if the difference is less than 4
     * if yes so is a script not real user 
     * else is real user 
     */
    public static function CheckWhoFillForm($scriptTime){
        $timeNow=time();
        $difference=$timeNow-$scriptTime;
        if($difference<4)
        {
            return 0;
        }
        return 1;
    }
    /**
     * check if the user is normal user or not
     */
    public static function checkHoneyBot($script){
       
        if(!empty($script))
        {
            return 0;
        }
        return 1;
    }
 }
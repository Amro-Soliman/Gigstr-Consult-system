<?php
// This page handels both user and admin login based on
// the page that refered to this script. 
include('../Classes/userClass.php');
include('Private/functions.php');


$user = new User;
$userExists = '';

$userinfo = find_user_by_email($user->email);
       
        if($userinfo){
        if(password_verify($user->password, $userinfo['password'])){
       $userExists = login($user->email, $userinfo['password']);
        }
    }
    
        if($userExists){
                redirect_to('../clintList.php');
            
            }else{
                echo 'no user was found';        
}




?>
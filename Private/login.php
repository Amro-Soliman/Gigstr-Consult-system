<?php
// This page handels both user and admin login based on
// the page that refered to this script. 
include_once('../Classes/userClass.php');
include_once('functions.php');

$adminref = '../Admin/admin.php';
$userref = '../Public/loginform.php';
$user = new User;
$userExists = '';
//$userName = $_POST['userName'];

$userinfo = find_client_by_username($user->userName);
       
        if($userinfo){
        if(password_verify($user->password, $userinfo['password'])){
       $userExists = loginClients($user->userName, $userinfo['password']);
        }
    }
    
        if($userExists){
                redirect_to('../Public/index.php');
            
            }else{
                echo 'no user was found';        
}




?>
<?php
//  This script is used for user Signing up page.
require_once('../Classes/db.php');
require_once('functions.php');
$db = new DB;
class Registerations {
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $companyName;
    public $companyAdress;
    public $tel;
    public $userName;
    public $id;
    public $oNumber;





    
    function __construct() {		
        $this->email = $_POST['email'] ?? '';

        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
        
        
        $this->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? '';
        
        $this->firstName = $_POST['firstName'] ?? '';
        $this->firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $this->lastName = $_POST['lastName'] ?? '';
        $this->lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $this->userName = $_POST['userName'] ?? '';
        $this->userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
        $this->companyAdress = $_POST['companyAdress'] ?? '';
        $this->companyAdress = filter_input(INPUT_POST, 'companyAdress', FILTER_SANITIZE_STRING);
        $this->companyName = $_POST['companyName'] ?? '';
        $this->companyName = filter_input(INPUT_POST, 'companyName', FILTER_SANITIZE_STRING);
        $this->id = $_POST['id'] ?? '';
        $this->oNumber = $_POST['oNumber'] ?? '';
        $this->oNumber = filter_input(INPUT_POST, 'oNumber', FILTER_SANITIZE_STRING);
        $this->tel = $_POST['tel'] ?? '';
        $this->tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
        
        
            }	
    
}
$new_register = new Registerations;

if(isset($_POST['submit']) && !oNumber_exists($new_register->oNumber) ){

    $addCompany = addClient($new_register->firstName, $new_register->lastName, $new_register->email, $hash, $new_register->companyName, $new_register->companyAdress, $new_register->tel, $new_register->userName, $new_register->oNumber);
      
    }else{
        echo 'the account already exists';
    }

//var_dump($stmt);



if(isset($_POST['createContact'])) {
    $addClient = add_client($new_register->firstName, $new_register->lastName, $new_register->email, $new_register->tel, $new_register->id);
}else{
    $addClient = '';
}

if(isset($_POST['editClient'])) {
    $editClient = updateClient($new_register->firstName, $new_register->lastName, $new_register->email, $new_register->tel, $new_register->id);
}else{
    $editClient = '';
}
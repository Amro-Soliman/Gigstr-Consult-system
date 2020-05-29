<?php
// This script has a USER class and Admin class which extending
// the first, both classes lies in their constructors one function
// for each, which is used in login process.
include('db.php');
include('../Private/functions.php');
class User {
    public $db;
    public $email;
    public $firstName;
    public $lastName;
    public $country;
    public $city;
    public $password;
    public $user;
    
    function __construct() {
        
        $this->db = new DB; 
        
        
        
        $this->userName =  $_POST['userName'] ?? '';
        $this->email =  filter_var($this->userName, FILTER_VALIDATE_STRING);
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $this->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); // kalle
        
            }	
        }
$user = new User;
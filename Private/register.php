<?php
//  This script is used for user Signing up page.
require_once('../Classes/db.php');
require_once('functions.php');
$db = new DB;
class Registerations {
    public $firstName;
    public $lastName;
    public $name;
    public $userName;
    public $comment;
    public $email;
    public $password;
    public $id;
    public $description;
    public $city;
    public $file;
    public $place;
    public $time;
    public $gigName;
    public $gigstrNr;
    public $date;
    public $serviceName;
    public $start_at;
    public $finish_at;





    
    function __construct() {		
        
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
        
        
        $this->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? '';
        
        $this->firstName = $_POST['firstName'] ?? '';
        $this->firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $this->status = $_POST['status'] ?? '';
        $this->status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
        $this->name = $_POST['name'] ?? '';
        $this->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $this->serviceName = $_POST['serviceName'] ?? '';
        $this->serviceName = filter_input(INPUT_POST, 'serviceName', FILTER_SANITIZE_STRING);
        
        $this->lastName = $_POST['lastName'] ?? '';
        $this->lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $this->city = $_POST['city'] ?? '';
        $this->city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $this->comment = $_POST['comment'] ?? '';
        $this->comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
        $this->start_at = $_POST['startTime'] ?? '';
        $this->finish_at = $_POST['finishTime'] ?? '';


        $this->id = $_POST['id'] ?? '';
        $this->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $this->gigId = $_POST['gigId'] ?? '';
        $this->gigId = filter_input(INPUT_POST, 'gigId', FILTER_SANITIZE_STRING);
        $this->tel = $_POST['tel'] ?? '';
        $this->tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
        $this->description = $_POST['description'] ?? '';
        $this->description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $this->file = $_POST['file'] ?? '';
        $this->file = filter_input(INPUT_POST, 'file', FILTER_SANITIZE_STRING);
        $this->place = $_POST['place'] ?? '';
        $this->place = filter_input(INPUT_POST, 'place', FILTER_SANITIZE_STRING);
        $this->time = $_POST['time'] ?? '';
        $this->hours = $_POST['hours'] ?? '';

        $this->gigName = $_POST['gigName'] ?? '';
        $this->gigName = filter_input(INPUT_POST, 'gigName', FILTER_SANITIZE_STRING);
        $this->gigstrNr = $_POST['gigstrNr'] ?? '';
        $this->gigstrNr = filter_input(INPUT_POST, 'gigstrNr', FILTER_SANITIZE_STRING);
        $this->date = $_POST['date'] ?? '';
        $this->date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
        
            }	
    
}
$new_register = new Registerations;
if(isset($_POST['submit'])){
    if(!userName_exists($new_register->userName)){
        $hash = password_hash($new_register->password, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (firstName, lastName, email, password)
VALUES ('$new_register->firstName', '$new_register->lastName', '$new_register->email', '$hash')";
$stmt = $db->pdo->prepare($sql);
$stmt->execute();
if($stmt){
redirect_to('../Public/loginform.php');
    }else{
        echo 'error';
    }
}
}

if(isset($_POST['createContact'])) {
  $addClient = add_client($new_register->firstName, $new_register->lastName, $new_register->email, $new_register->tel, $new_register->id);
}else{
    $addClient = '';
}
if($addClient) {
    redirect_to('../Staff/clintList.php');

}

if(isset($_POST['editClient'])) {
    $editClient = updateClient($new_register->firstName, $new_register->lastName, $new_register->email, $new_register->tel, $new_register->id);
}else{
    $editClient = '';
}

/*if(isset($_POST['addGigstr'])) {
   $addGigstr = addGigstr($new_register->name, $new_register->email,  $new_register->description, $new_register->tel, $new_register->city, $new_register->file );
}else{
    $addGigstr = '';
} */
$addGigstr = '';
if($addGigstr) {
   redirect_to('../Staff/gigstrsList.php');
}else{
    $addGigstr = '';

}
if(isset($_POST['addComment'])) {
    $addComment = add_comment($new_register->comment, $new_register->id, $new_register->name); 

    }else{
        $addComment = "";
    }

    if(isset($_POST['createGig'])) {
        
$var = '';
        $addNewGig= addGig($new_register->gigName , $new_register->id); 
    
        }else{
            $addNewGig = "";
        }
    
        if(isset($_POST['addService'])) {
            $addService = addService($new_register->serviceName, $new_register->gigId); 
        
            }else{
                $addService = "";
            }
            if(isset($_POST['changeStatus'])) {
                $selectedStatus = $_POST['status'];
                $changeStatus = change_status( $new_register->gigId, $new_register->status); 
            
                }else{
                    $changeStatus = "";
                }
                if(isset($_POST['createShift'])) {
                    $stime = $new_register->start_at;
 $startTime = date('H:i ', strtotime($stime));
 $ftime = $new_register->finish_at;
 $finishTime = date('H:i   ', strtotime($ftime));


                    $addShift = add_shift($new_register->name, $new_register->place, $new_register->date, $startTime, $finishTime,  $new_register->gigstrNr,$new_register->hours, $new_register->gigId, $new_register->id); 
                   var_dump($_POST);
                }else{
                        $addShift = "";
                    }
<?php
include('Assets/staffHeader.php');

if(isset($_POST['addGigstr'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $tel = $_POST['tel'];
    $city = $_POST['city']; 

}
$targetDir = "images";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["addGigstr"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                 addGigstr($name, $email,  $description, $tel, $city, $fileName ); 
        }
    }}

    
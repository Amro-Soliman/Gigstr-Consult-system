<?php
include('Assets/staffHeader.php');
//session_start();
if(isset($_GET['id']) && isset($_GET['shiftId'])) {
    $id =$_GET['id'];
    $gigId = $_GET['shiftId'];
    var_dump($_GET);
    $client = $_GET['client'];
    add_gig_bokning($id,$gigId,$client, $_SESSION['shiftID'],$_SESSION['shift_date']);

    //echo 'yes';
}else{
    echo 'no';
}
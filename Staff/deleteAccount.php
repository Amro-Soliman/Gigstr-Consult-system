<?php
include('Assets/staffHeader.php');
if(isset($_GET['contactNr'])) {
    $contact = $_GET['contactNr'];
}
$removedContact = removeContact($contact);

if($removedContact) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>

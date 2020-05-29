<?php
include('Assets/staffHeader.php');
if(isset($_GET['gigstrNr'])) {
    $gigstrNr = $_GET['gigstrNr'];
        $gigNr = $_GET['gigNr'];
        $removedGigstr = removeGigstr($gigstrNr, $gigNr);


}

// if($removedGigstr) {
//     header('Location: ' . $_SERVER['HTTP_REFERER']);
//     exit;
// }
?>

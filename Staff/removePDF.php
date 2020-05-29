<?php
include('Assets/staffHeader.php');
if(isset($_GET['PDF'])) {
    $pdf = $_GET['PDF'];
        $gigNr = $_GET['gigNr'];
        $removedPDF = removeOffer($gigNr, $pdf);


}

// if($removedGigstr) {
//     header('Location: ' . $_SERVER['HTTP_REFERER']);
//     exit;
// }
?>

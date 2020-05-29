<?php
include('Assets/staffHeader.php');
if(isset($_GET['report'])) {
    $report = $_GET['report'];
        $gigNr = $_GET['gigNr'];
        $removedReport = removeReport($gigNr, $report);


}

// if($removedGigstr) {
//     header('Location: ' . $_SERVER['HTTP_REFERER']);
//     exit;
// }
?>

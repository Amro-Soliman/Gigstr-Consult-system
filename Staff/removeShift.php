<?php
include('Assets/staffHeader.php');
if(isset($_GET['shiftId'])) {
    $shiftId = $_GET['shiftId'];
        $removedShift = removeShift($shiftId);

			header("Location: $_SERVER[HTTP_REFERER]");

}

// if($removedGigstr) {
//     header('Location: ' . $_SERVER['HTTP_REFERER']);
//     exit;
// }
?>

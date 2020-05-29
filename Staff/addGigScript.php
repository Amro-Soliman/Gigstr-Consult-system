<?php
include('Assets/staffHeader.php');

if(isset($_POST['createGig'])) {
    	addGig($gigName, $place,  $time, $client_id, $gigstrNr );

}
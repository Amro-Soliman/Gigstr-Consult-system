<?php
include('../Private/functions.php');
$msg = ''; 
if(isset($_SESSION['userId'])){
  $userId = $_SESSION['userId'];
  $result = get_user_by_id($userId);
  $msg = "<div id='logreg'>";
  $msg .= "<h5 id='loggedUser'>" . "<span class='name'> $result </span>" . "</h5></br>";
  $msg .= "<form action='../Private/logout.php' method='post'> </br>";
  $msg .= "<input id='logoutbtn' type='submit'  name='logout' value='Logout'>";
  $msg .= "</form>";
  $msg .= "</div>"; 
  // Checking the file path, if the path was neither
  // signup page nor user login page, then the user 
  // gets these two links bellow [Signup , Loging].
      
}else {
    redirect_to('../Staff/login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
		
   <!-- Including our scripting file. -->
<link href="Assets/main.css" rel="stylesheet">
<script type="text/javascript" src="js.js"></script>


<title>Index</title>
</head>
<body>

<div id='kundkort-container'>

    <div id="kundkort-header">
        <h4 id='logo'>Gigstr <span>BETA<span></h4>
        <ul id='nav'>
            <li> <a href="clintList.php" >Kunder</a></li>
            <li> <a href="gigstrsList.php"> Gigstr </a></li>
        </ul>
        <div id='kund-account'><a href='addClient.php'>Skapa konto </a></div>
        <div id="logreg"><?php echo $msg; ?></div>
    </div>

   
          


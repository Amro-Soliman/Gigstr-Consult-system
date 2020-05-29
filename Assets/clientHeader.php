



<?php
 include('../Private/functions.php');

$msg = '';
if(isset($_SESSION['clientId'])){
  $userId = $_SESSION['clientId'];
  $result = get_client_by_id($userId);
  $companyName = $result['companyName'];

  $msg = "<div id='logreg'>";
  $msg .= "<a id='loggedUser' href='clientProfile.php?id=$result[id]'>" . "<span class='name'> $result[companyName] </span>" . "</a></br>";
    $varu = ucfirst($companyName);
    $var = substr($varu, 0, 1) . '.';
    
   $msg .= "<div id='profilePictureMain'>" .  $var .   "</div>";
  $msg .= "<form action='../Private/logout.php' method='post'> </br>";
  $msg .= "<input id='logoutIndex' type='submit'  name='logout' value='Logout'>";
  $msg .= "</form>";
  $msg .= "</div>"; 
  // Checking the file path, if the path was neither
  // signup page nor user login page, then the user 
  // gets these two links bellow [Signup , Loging].
      
}else {
  redirect_to('loginForm.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <!-- Including our scripting file. -->
<link href="../Staff/Assets/main.css" rel="stylesheet">


<title>Index</title>
</head>
<body>

<div id='kundkort-container'>

    <div id="kundkort-header">
        <h4 id='logo'>Gigstr <span>BETA<span></h4>
        <ul id='nav'>

<li> <a href="utforska.php">utförska</a></li>
<li> <a href="faktoror.php">Offert </a></li>
<li> <a href="personal.php">Personal</a></li>
<li> <a href="reports.php">Rapporter</a></li>
<li> <a href="#">Support</a></li>
</ul>

         <div id="logreg"><?php echo $msg; ?></div>
    </div>

   
          

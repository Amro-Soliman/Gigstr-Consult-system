<?php
?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta charset="UTF8">
<link href="../Assets/main.css" rel="stylesheet">  
</head>
<body>
    
    <div id="signup">
        <form action="Private/register.php" method="post">
        <label for="firstName">Förnamn</br>
            <input type="text" name="firstName"> </label></br></br>
            <label for="lastName">Efternamn </br>
            <input type="text" name="lastName"> </label></br></br>
            <label for="companyName">Företagsnamn</br>
            <input type="text" name="companyName"> </label></br></br>
            <label for="companyAddress">Företags Adress</br>
            <input type="text" name="companyAddress"> </label></br></br>
            <label for="email">Email</br>
            <input type="email" name="email"></label></br></br>
            <label for="tel">Telefon nr:</br>
            <input type="text" name="tel"> </label></br></br>
            <label for="password">Password</br>
            <input type="password" name="password"></label></br></br>
            
            
            <br>
            <input style='background-color:rgb(53, 86, 148); color:white;' type="submit" name="submit" value="Submit">
            </form>
    </div>

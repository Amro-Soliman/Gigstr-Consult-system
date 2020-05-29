<?php
include('Assets/staffHeader.php');

/*$msg = ''; 
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
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <!-- Including our scripting file. -->
<link href="Assets/main.css" rel="stylesheet">
<script type="text/javascript" src="js.js"></script>


<title>Index</title>
*/?>
  <div id='kundkort-main'>
     <div id="signup">
    <h1 id='clientHelp'> Registerinengen av ett företgskonto </h1> 
        <form id='addClientForm'  class='form'  method="post">
        <label class='label' for="companyName">Företagsnamn
            <input class='input' type="text"  name="companyName"> </label></br></br>
            <label  class='label' for="companyAdress">Företags Adress
            <input class='input' type="text"  name="companyAdress"> </label></br></br>
            <label class='label' for="organisationsNumber">organisationsNumber
            <input class='input' id='oNumber' type="text" name="oNumber"> <div id='output'></div>  
</label> </br></br>
        <label class='label' for="firstName">Förnamn
            <input class='input' type="text" id="firstName" name="firstName"> </label></br></br>
            <label class='label' for="lastName">Efternam
            <input class='input' type="text" id="lastName" name="lastName"> </label></br></br>
            
            <label class='label' for="email">Mejladress
            <input  class='input' type="email" id="email" name="email"></label></br></br>
            <label class='label' for="tel">Telefon nr:
            <input class='input'  type="text" id="tel" name="tel"> </label></br></br>
            <label class='label' for="userName">Användernamn
            <input class='input' type="text" id="userName" name="userName"></label></br></br>


            <label class='label' for="password">Password
            <input class='input' type="password" id="password" name="password"></label></br></br>
            
            
            <br>
            <input id='subm' type="submit" name="submit" value="Submit">
            </form>
    </div>
    <script>
    $(document).ready(function() {
       $("#addClientForm").submit(function(e){
         
          var formData =  $(this).serialize();


            $.ajax({
              url: 'onCheck.php',
              method: 'GET',
              data: {data: formData  },
              dataType: "json",
              headers: {Accept : "application/json;charset=utf-8"},

 
              success: function(data){
                
                console.log(data);
                //data.code == 200 ? console.log('terrific') : console.log('bad request');
                data.code == 200 ? $("#output").html("This organisation number is already used"  + data.name) : window.location = 'clintList.php';
               
              }
            });
          
      });
    });
    </script>
  </body>
  </html>

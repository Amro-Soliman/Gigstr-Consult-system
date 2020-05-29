<?php
include('Assets/staffHeader.php');
?>
  <div id='kundkort-main'>
    <div id="signup">
    <h1 id='clientHelp'> Registerinengen av en ny gigstr </h1> 
        <form id='addGigstrForm'  class='form' action="addGigstrScript.php" enctype="multipart/form-data" method="post"> 
        <label class='label' for="city">City
            <input class='input' type="text"  name="city"> </label></br></br>
            <label class='label' for="description">description
            <textarea class='input' id='description'  name="description"></textarea> <div id='output'></div>  
</label> </br></br>
        <label class='label' for="firstName">För-efternamn
            <input class='input' type="text" id="name" name="name"> </label></br></br>
             
            <label class='label' for="email">Mejladress
            <input  class='input' type="email" id="email" name="email"></label></br></br>
            <label class='label' for="tel">Telefon nr:
            <input class='input'  type="text" id="tel" name="tel"> </label></br></br>
            <input type="file" name="file">

            
            <br>
            <input id='subm' type="submit" name="addGigstr" value="Submit">
            </form>
    </div>
   </div>
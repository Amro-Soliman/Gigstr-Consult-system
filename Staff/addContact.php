<?php
include('Assets/staffHeader.php');
?>
  <div id='kundkort-main'>

<?php

if(isset($_get['id'])) {
echo $_get['id'];}
?>
<div id='contactPerson'>
        <h1 id='contactHelp'> Lägg till en kontakt person</h1>
        <form class='form' action="../Private/register.php" method="post">
            <label class='label' for="firstName">First name
            <input class='input'type="text" name="firstName"> </label></br></br>
            <label  class='label' for="lastName">Last name
            <input class='input' type="text" name="lastName"> </label></br></br>
            <label class='label' for="email">Email
            <input class='input'type="email" name="email"></label></br></br>
            <label class='label' for="tel">Telefonnummer
            <input class='input' type="text" name="tel"></label></br></br>
            <input class='label' type='hidden' name='id' value='<?php echo $_GET["id"]; ?>'>
            
            
            <br>
            <input id='subm' type="submit" name="createContact" value="Submit">
            </form>
            </div>
    </div>
    </div>
  
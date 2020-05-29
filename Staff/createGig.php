<?php
include('Assets/staffHeader.php');
?>
  <div id='kundkort-main'>

<?php

if(isset($_get['id'])) {
echo $_get['id'];}
?>  
<div id='contactPerson'>
        <h1 id='contactHelp'> Lägg till en Gig</h1>
        <form class='form' action="../Private/register.php" method="post">
            <label class='label' for="gigName">Gig namn
            <input class='input'type="text" name="gigName"> </label></br></br>
            
            <input class='label' type='hidden' name='id' value='<?php echo $_GET["id"]; ?>'>
            
            
            <br>
            <input id='subm' type="submit" name="createGig" value="Submit">
            </form>
            </div>
    </div>
    </div>
  
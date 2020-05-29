<?php
include('Assets/staffHeader.php');
?>
  <div id='kundkort-main'>

<?php

if(isset($_get['id'])) {
echo $_get['id'];}
?>  
<div id='contactPerson'>
        <h1 id='contactHelp'> Lägg till ett shift</h1>
        <form class='form' action="../Private/register.php" method="post">
            <label class='label' for="shiftName">Shift namn
            <input class='input'type="text" name="name"> </label></br></br>
            <label  class='label' for="gigstrNr">Antal gigstrs
            <input class='input' type="text" name="gigstrNr"> </label></br></br>
            <label class='label' for="place">Adress
            <input class='input'type="text" name="place"></label></br></br>
            <label class='label' for="date"> datum
            <input class='input' type="date" name="date"></label></br></br>
            <label class='label' for="finishDate">Start 
            <input class='input' type="time" name="startTime"></label></br></br>
            <label class='label' for="finishDate">Slut 
            <input class='input' type="time" name="finishTime"></label></br></br>
            <label class='label' for="hours">Antal timmar
            <input class='input' type="text" name="hours"></label></br></br>
 
            <input class='label' type='hidden' name='gigId' value='<?php echo $_GET["id"]; ?>'>
            <input class='label' type='hidden' name='id' value='<?php echo $_SESSION["client_id"]; ?>'>

            
            
            <br>
            <input id='subm' type="submit" name="createShift" value="Submit">
            </form>
            </div>
    </div>
    </div>
  
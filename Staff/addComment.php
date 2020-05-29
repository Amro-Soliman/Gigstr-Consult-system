<?php
include('Assets/staffHeader.php');
?>
  <div id='kundkort-main'>
    <div id="signup">
    <h1 id='clientHelp'> Registerinengen av ett företgskonto </h1> 
        <form id='addGigstrForm'  class='form' action="../Private/register.php"  method="post">
        <label class='label' for="name">Name
            <input class='input' type="text"  name="name"> </label></br></br>
        
            <label class='label' for="comment">Comment
            <textarea class='input' id='description'  name="comment"></textarea> <div id='output'></div>  
</label> </br></br>
<input class='label' type='hidden' name='id' value='<?php echo $_GET["id"]; ?>'>


            
            <br>
            <input id='subm' type="submit" name="addComment" value="Submit">
            </form>
    </div>
   
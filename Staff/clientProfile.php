<?php
include('Assets/staffHeader.php');
$result = '';
$result = get_client_by_id($_GET['id']);
$_SESSION['client_id'] = $_GET['id'];
$gigs = get_gigs_by_client_id($_GET['id']);
$companyName = $result['companyName'];
//echo $companyName;
?>

<div id='kundkort-main'>
    <div id='cHeader'>
        <?PHP 
        //echo '<br>';
        $varu = ucfirst($companyName);
        $var = substr($varu, 0, 1) . '.';
        ?>
         <div id='logo'> <?php echo $var; ?> </div>

    <!-- <img src='../Unknown.png'  id='profilePicture' alt='Profile Picture'> -->
        
        <h2> <?php echo $result['companyName'] . '</br>'; ?> </h2>
        <p> <?php  echo $result['companyAdress'] . '</br>'; ?> </p>

    </div>

    <div id='contact'>
        <h5>Kontakt person(er)</h5><br><br>

        <a href='addContact.php?id=<?php echo $result["id"]; ?>'> Lägg till Kontaktperson</a>
        <!-- <a href='addContact.php?id=' . <?php echo $result["id"]; ?> > Lägg till Kontaktperson</a> -->
    </div>

    

    <div id="contactInfo">

        <?php
        $src = "../images/Delete.svg";
        $srcc = "../images/Edit.svg";

        $contacts = get_contacts_by_client_id($_GET['id']); 
        ?>
        <table id="table2">
        <tr id="<?php echo $contact['id'] ?>">                       
            <td><?php echo $result['firstName'] . '&nbsp;' . $result['lastName']; ?></td>

                        <td><?php echo $result['email']; ?></td>
                        <td><?php echo $result['tel']; ?></td>
                        <td><a href="editClient.php?id=<?php echo $result['id']; ?>"><img class="editImage" src='<?php echo $srcc; ?>'></a></td>
                    </tr>
        <?php
        if($contacts) {

            //echo '<img src="../deleteIcon.svg"/>';
        foreach($contacts as $contact) { ?>
            <tr id="<?php echo $contact['id'] ?>">                       
            <td><?php echo $contact['firstName'] . '&nbsp;' . $contact['lastName']; ?></td>

                        <td><?php echo $contact['email']; ?></td>
                        <td><?php echo $contact['tel']; ?></td>
                        <td><img class="removeImage" src=' <?php echo $src; ?> '></td>
                    </tr>
                    <?php } ?>


        <?php
        }
        else{
            $contacts = '';
        }
        //var_dump($contact);

        ?>
        </table>
    </div>
    
    
    <div class="kund-gig">
        <h5 class="kundkort-rubrik">Gig</h5>
        <div class="skffa-gig">
            <a href='createGig.php?id=<?php echo $result["id"]; ?>'> Skapa gig</a>
        </div>

        <div class="kund-gig-wrapper gig-wrapper">
            <div class="kund-gig-header">

                <?php 
                if($gigs) {
                foreach($gigs as $gig) {
                    if(isset($gig['id'])){
                        echo '<h3>' .$gig['gigName'] . '</h3>';
                ?>
                <div class="gig-open"><img src="../images/open-icon.svg"></div>

            </div>

            <!---------------- LÄGGA TILL OLIKA DELAR AV GIGET ------------------->

            <div class="kund-gig-container">

                <div class="gig-delar-wrapper">
                    <div class="gig-delar-container">
                        <div class="gig-delar-rubrik"><h4>Shifts</h4></div>
                        <div class="open-del"><img src="../images/open-icon.svg"></div> 
                    </div>
                    
                    <div class="add-del">
                        <a href='createShift.php?id=<?php echo $gig['id']; ?>'> Skapa ett shift</a>
                        <div class="added-delar-container">
                            <?php $shifts = get_shifts_by_gig_id($gig['id']); ?>

                            <!----- Shift veskrivning----->
                            <div class="shift-beskrivning-wrapper">
                                <div class="shift-info">
                                    <?php
                                    // Siftnam
                                    if(isset($shifts)){
                                    foreach($shifts as $shift) {
                                  
                                    $rawDate1 = strtotime($shift['shift_date']);
                                    $_SESSION['shift_date'] = $shift['shift_date'];
                                    $gigDate1 = date('j-M-Y' ,$rawDate1);
                                    $finaldate1 = explode("-", $gigDate1);
                                    $rawDate2 = strtotime($shift['finish_at']);
                                    $gigDate2 = date('j-M-Y' ,$rawDate2);
                                    $finaldate2 = explode("-", $gigDate2);
                                    $shiftPersons = get_shift_persons_by_gig_id( $shift['id']);
                                    echo    "<h5>" .$shift['name'] . '</h5>';
                                    if(isset($shiftPersons['result'])) { 

                                    // Siftnam Slut

                                    // Shift info
                                    echo   '<p> bokade gigstr '.   0  . ' Av ' . $shift['gigstrNr']  . '</p>';
                                        }else{
                                            echo   '<p> bokade gigstrs '.   count($shiftPersons)   . ' Av ' . $shift['gigstrNr']  . '</p>';
                                    
                                            echo '';
                                        }
                                        echo '<h6>Shift adress:</h6> ' . "<p>$shift[place]" ;
                                        
                                    //  echo   '<p>'.  count($gigsPersons) . ' Av ' . $gig['gigstrNr'] . '</p>';
                                    
                                        //echo 'Antal gigstr: ' . $gig['gigstrNr'] . '</br>';
                                        echo '<h6>Start datum: </h6> ' .'<p>' . $finaldate1[0] . " " . $finaldate1[1] . " " . $finaldate1[2] ." " . '</p>';
                                        echo '<h6>Start:</h6> ' . $shift['start_at'];
                                        echo  '<h6>Slut: </h6>'. $shift['finish_at'];
                                    // Shift info slut    
                                       ?>

                                </div>
                                <div class="shift-gigstr">
                                    <?php
                                    echo  '<h4>Gigstrs</h4>';
                                    $_SESSION['shiftId'] = $shift['id'];
                                    echo '<a href=' . "gigstrBokning.php?shiftId=$shift[id]&client=$result[id]>" .'Lägg till gigstr </a><br>';
                                    
                                        $shiftPersons = get_shift_persons_by_gig_id( $shift['id']);
                                    
                                        if(isset($shiftPersons)) {
                                            foreach($shiftPersons as $shiftPerson){
                                                if(isset($shiftPerson['gigstr_id'])){
                                                    
                                        
                                        
                                                $gigstrs = get_gigstr_by_id($shiftPerson['gigstr_id']) ?? '';
                                            // var_dump($gigstrs);
                                                if(isset($gigstrs)) {
                                                    echo '<table '. "class='gigstr-list'>";
                                    
                                    
                                        
                                                
                                            echo "<tr  id='$gigstrs[id]'>"  .'<td> '. "<img   src=../images/" . $gigstrs["file_name"].  ">" . '</td>' . '<td>'.  '<p>' .  '<a class="clientListLinks" href='  . 'gigstrProfile.php?id=' . $gigstrs['id']  . '>' .$gigstrs['name'] . '</a>' .  '</p>' . '</td>' . '<td>'  .  '<img class='. 'removeGigtr    ' . 'id='.  $shift['id']  .' src=' . $src  .   '>'                     . '</td>'
                                            . '</tr>';
                                            echo '</table>';
                                            
                                    
                                                    }  
                                                        }    

                                            }
                                            }
                                            echo '<a class="shift-delete" href=' . "removeShift.php?shiftId=$shift[id]>" .'Ta bort shift </a>';

                                    
                                            }
                                            }               
                                    
                                    
                                                }else{
                                                    $shifts = '';
                                                }

                                    ?>
                                    
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!----------- Offerter ------------>

                <div class="gig-delar-wrapper">
                    <div class="gig-delar-container">
                            <div class="gig-delar-rubrik"><h4>Offerter</h4></div>
                            <div class="open-del"><img class="" src="../images/open-icon.svg"></div> 
                    </div>
                    <div class="add-del">
                      
                        <form method="post" action=" uploadGigRepport.php" enctype="multipart/form-data">
                            <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
                            <tr>
                            <td width="246">
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                            <input name="userfile" type="file" id="userfile">
                            <input type="hidden" name="gigId" value="<?php echo $gig['id']; ?>">

                            </td>
                            <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
                            </tr>
                            </table>
                        </form>

                        <div class="added-delar-container">
                            <!------ Filar ------->
                            <?php
                            $pdfs = get_offers_by_client_id($gig['id']);
                                if($pdfs){
                                foreach($pdfs as $pdf){
                                    
                                echo '<table>';
                            
                                echo "<tr id='$gig[id]'>" . '<td>' . "<a ". "target=" .'_blank '. "href=" . "../uploads/$pdf[offer]>" . $pdf['offer'] . '</a>' . '</td>' . '<td>' .  '<img class='. 'removePDF ' . 'id='.  $pdf['id']  .' src=' . $src  .   '>'                     . '</td>'
                                    . '</td>'.'</tr>';
                                    echo '</table>';
                                }}else{
                                    $pdf = '';
                                }

                                ?>
 
                        </div>
                    </div>
                </div>                                        

                <!----------- Offerter Slut ------------>   


                <!----------- Rapporter ------------>

                <div class="gig-delar-wrapper">
                    <div class="gig-delar-container">
                            <div class="gig-delar-rubrik"><h4>Rapporter</h4></div>
                            <div class="open-del"><img class="" src="../images/open-icon.svg"></div> 
                    </div>
                    <div class="add-del">
                      
                        <form method="post" action="uploadGigPDF.php" enctype="multipart/form-data">
                            <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
                            <tr>
                            <td width="246">
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                            <input name="userfile" type="file" id="userfile">
                            <input type="hidden" name="gigId" value="<?php echo $gig['id']; ?>">

                            </td>
                            <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
                            </tr>
                            </table>
                        </form>

                        <div class="added-delar-container">
                            <!------ Filar ------->
                            <?php
                            $reports = get_pdf_reports_by_client_id($gig['id']);
                                if($reports){
                                foreach($reports as $report){
                                    
                                echo '<table>';
                            
                                echo "<tr id='$gig[id]'>" . '<td>' . "<a ". "target=" .'_blank '. "href=" . "../uploads/$report[PDF_reports]>" . $report['PDF_reports'] . '</a>' . '</td>' . '<td>' .  '<img class='. 'removeReport ' . 'id='.  $report['id']  .' src=' . $src  .   '>'                     . '</td>'
                                    . '</td>'.'</tr>';
                                    echo '</table>';
                                }}else{
                                    $report = '';
                                }

                                ?>
 
                        </div>
                    </div>
                </div> 
                <!----------- SLUT PÅ RAPPORTER ----------->


                <!----------- Extra Tjänster ----------->

                <div class="gig-delar-wrapper">
                    <div class="gig-delar-container">
                        <div class="gig-delar-rubrik"><h4>Extra tjänster</h4></div>
                        <div class="open-del"><img src="../images/open-icon.svg"></div> 
                    </div>
                    <div class="add-del">
                        <form id='addGigstrForm'  class='form' action="../Private/register.php" enctype="multipart/form-data" method="post"> 
                        <label class='label' for="city">Tjänst Namn
                        <input class='input' type="text"  name="serviceName"> </label>
                        <input type="hidden" name="gigId" value="<?php echo $gig['id']; ?>">
                        <input id='subm' type="submit" name="addService" value="Submit">
                        </form>
                        <div class="added-delar-container">
                            <!------ Tjänster ------->
                            <?php
                            $services = get_services_by_gig_id($gig['id']);
                            if(!empty($services)){
                            foreach($services as $service)
                            {
                                echo '<br>';
                                echo '<h5>' . $service['name'] .'</h5>';
                                echo $service['status']. '<br>';
                                ?>
                                <form id='addGigstrForm'  class='form' action="../Private/register.php" enctype="multipart/form-data" method="post"> 
                                    <label class='label' for="ststus">Ändra status 
                                    <select name="status">
                                    <option value="">Välj ett status</option>

                            <option value="I Progress">I progress</option>
                            <option value="Klart">Klart</option>


                            </select>
                                        <input type="hidden" name="gigId" value="<?php echo $gig['id']; ?>">


                                        
                                        <input id='subm' type="submit" name="changeStatus" value="Submit">
                                        
                                        </form>

                            <?php

                            }
                            }
                            
                            
                            }
                            }

                            // $shi =     get_last_shift_date_per_client_by_shift_id($shift['id']);
                            // $date =date("Y-m-d");
                            // var_dump($shi);
                         
                            if($gigs) {
                                foreach($gigs as $gig) {
                                    $shi =     get_last_shift_date_per_client_by_shift_id($gig['id']);
                                    $date =date("Y-m-d");

                                    if(isset($gig['id']) && $date > $shi){
                                        
                                        echo '<h3>' .$gig['gigName'] . '</h3>';
                                ?>
                                <div class="gig-open"><img src="../images/open-icon.svg"></div>
                
                            </div>
                
                            <!---------------- LÄGGA TILL OLIKA DELAR AV GIGET ------------------->
                
                            <div class="kund-gig-container">
                
                                <div class="gig-delar-wrapper">
                                    <div class="gig-delar-container">
                                        <div class="gig-delar-rubrik"><h4>Shifts</h4></div>
                                        <div class="open-del"><img src="../images/open-icon.svg"></div> 
                                    </div>
                                    
                                    <div class="add-del">
                                        <a href='createShift.php?id=<?php echo $gig['id']; ?>'> Skapa ett shift</a>
                                        <div class="added-delar-container">
                                            <?php
                             $shifts = get_shifts_by_gig_id($gig['id']);
?>
                            <!----- Shift veskrivning----->
                            <div class="shift-beskrivning-wrapper">
                                <div class="shift-info">
                                    <?php
                                    // Siftnam
                                    if(isset($shifts)){
                                    foreach($shifts as $shift) {
                                  
                                    $rawDate1 = strtotime($shift['shift_date']);
                                    $_SESSION['shift_date'] = $shift['shift_date'];
                                    $gigDate1 = date('j-M-Y' ,$rawDate1);
                                    $finaldate1 = explode("-", $gigDate1);
                                    $rawDate2 = strtotime($shift['finish_at']);
                                    $gigDate2 = date('j-M-Y' ,$rawDate2);
                                    $finaldate2 = explode("-", $gigDate2);
                                    $shiftPersons = get_shift_persons_by_gig_id( $shift['id']);
                                    echo    "<h5>" .$shift['name'] . '</h5>';
                                    if(isset($shiftPersons['result'])) { 

                                    // Siftnam Slut

                                    // Shift info
                                    echo   '<p> bokade gigstr '.   0  . ' Av ' . $shift['gigstrNr']  . '</p>';
                                        }else{
                                            echo   '<p> bokade gigstrs '.   count($shiftPersons)   . ' Av ' . $shift['gigstrNr']  . '</p>';
                                    
                                            echo '';
                                        }
                                        echo '<h6>Shift adress:</h6> ' . "<p>$shift[place]" ;
                                        
                                    //  echo   '<p>'.  count($gigsPersons) . ' Av ' . $gig['gigstrNr'] . '</p>';
                                    
                                        //echo 'Antal gigstr: ' . $gig['gigstrNr'] . '</br>';
                                        echo '<h6>Start datum: </h6> ' .'<p>' . $finaldate1[0] . " " . $finaldate1[1] . " " . $finaldate1[2] ." " . '</p>';
                                        echo '<h6>Start:</h6> ' . $shift['start_at'];
                                        echo  '<h6>Slut: </h6>'. $shift['finish_at'];
                                    // Shift info slut    
                                       ?>

                                </div>
                                <div class="shift-gigstr">
                                    <?php
                                    echo  '<h4>Gigstrs</h4>';
                                    $_SESSION['shiftId'] = $shift['id'];
                                    echo '<a href=' . "gigstrBokning.php?shiftId=$shift[id]&client=$result[id]>" .'Lägg till gigstr </a><br>';
                                    
                                        $shiftPersons = get_shift_persons_by_gig_id( $shift['id']);
                                    
                                        if(isset($shiftPersons)) {
                                            foreach($shiftPersons as $shiftPerson){
                                                if(isset($shiftPerson['gigstr_id'])){
                                                    
                                        
                                        
                                                $gigstrs = get_gigstr_by_id($shiftPerson['gigstr_id']) ?? '';
                                            // var_dump($gigstrs);
                                                if(isset($gigstrs)) {
                                                    echo '<table '. "class='gigstr-list'>";
                                    
                                    
                                        
                                                
                                            echo "<tr  id='$gigstrs[id]'>"  .'<td> '. "<img   src=../images/" . $gigstrs["file_name"].  ">" . '</td>' . '<td>'.  '<p>' .  '<a class="clientListLinks" href='  . 'gigstrProfile.php?id=' . $gigstrs['id']  . '>' .$gigstrs['name'] . '</a>' .  '</p>' . '</td>' . '<td>'  .  '<img class='. 'removeGigtr    ' . 'id='.  $shift['id']  .' src=' . $src  .   '>'                     . '</td>'
                                            . '</tr>';
                                            echo '</table>';
                                            
                                    
                                                    }  
                                                        }    

                                            }
                                            }
                                            echo '<a class="shift-delete" href=' . "removeShift.php?shiftId=$shift[id]>" .'Ta bort shift </a>';

                                    
                                            }
                                            }               
                                    
                                    
                                               // OLD ELSE
                                    ?>
                                    
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!----------- Offerter ------------>

                <div class="gig-delar-wrapper">
                    <div class="gig-delar-container">
                            <div class="gig-delar-rubrik"><h4>Offerter</h4></div>
                            <div class="open-del"><img class="" src="../images/open-icon.svg"></div> 
                    </div>
                    <div class="add-del">
                      
                        <form method="post" action=" uploadGigRepport.php" enctype="multipart/form-data">
                            <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
                            <tr>
                            <td width="246">
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                            <input name="userfile" type="file" id="userfile">
                            <input type="hidden" name="gigId" value="<?php echo $gig['id']; ?>">

                            </td>
                            <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
                            </tr>
                            </table>
                        </form>

                        <div class="added-delar-container">
                            <!------ Filar ------->
                            <?php
                            $pdfs = get_offers_by_client_id($gig['id']);
                                if($pdfs){
                                foreach($pdfs as $pdf){
                                    
                                echo '<table>';
                            
                                echo "<tr id='$gig[id]'>" . '<td>' . "<a ". "target=" .'_blank '. "href=" . "../uploads/$pdf[offer]>" . $pdf['offer'] . '</a>' . '</td>' . '<td>' .  '<img class='. 'removePDF ' . 'id='.  $pdf['id']  .' src=' . $src  .   '>'                     . '</td>'
                                    . '</td>'.'</tr>';
                                    echo '</table>';
                                }}else{
                                    $pdf = '';
                                }

                                ?>
 
                        </div>
                    </div>
                </div>                                        

                <!----------- Offerter Slut ------------>   


                <!----------- Rapporter ------------>

                <div class="gig-delar-wrapper">
                    <div class="gig-delar-container">
                            <div class="gig-delar-rubrik"><h4>Rapporter</h4></div>
                            <div class="open-del"><img class="" src="../images/open-icon.svg"></div> 
                    </div>
                    <div class="add-del">
                      
                        <form method="post" action="uploadGigPDF.php" enctype="multipart/form-data">
                            <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
                            <tr>
                            <td width="246">
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                            <input name="userfile" type="file" id="userfile">
                            <input type="hidden" name="gigId" value="<?php echo $gig['id']; ?>">

                            </td>
                            <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
                            </tr>
                            </table>
                        </form>

                        <div class="added-delar-container">
                            <!------ Filar ------->
                            <?php
                            $reports = get_pdf_reports_by_client_id($gig['id']);
                                if($reports){
                                foreach($reports as $report){
                                    
                                echo '<table>';
                            
                                echo "<tr id='$gig[id]'>" . '<td>' . "<a ". "target=" .'_blank '. "href=" . "../uploads/$report[PDF_reports]>" . $report['PDF_reports'] . '</a>' . '</td>' . '<td>' .  '<img class='. 'removeReport ' . 'id='.  $report['id']  .' src=' . $src  .   '>'                     . '</td>'
                                    . '</td>'.'</tr>';
                                    echo '</table>';
                                }}else{
                                    $report = '';
                                }

                                ?>
 
                        </div>
                    </div>
                </div> 
                <!----------- SLUT PÅ RAPPORTER ----------->


                <!----------- Extra Tjänster ----------->

                <div class="gig-delar-wrapper">
                    <div class="gig-delar-container">
                        <div class="gig-delar-rubrik"><h4>Extra tjänster</h4></div>
                        <div class="open-del"><img src="../images/open-icon.svg"></div> 
                    </div>
                    <div class="add-del">
                        <form id='addGigstrForm'  class='form' action="../Private/register.php" enctype="multipart/form-data" method="post"> 
                        <label class='label' for="city">Tjänst Namn
                        <input class='input' type="text"  name="serviceName"> </label>
                        <input type="hidden" name="gigId" value="<?php echo $gig['id']; ?>">
                        <input id='subm' type="submit" name="addService" value="Submit">
                        </form>
                        <div class="added-delar-container">
                            <!------ Tjänster ------->
                            <?php
                            $services = get_services_by_gig_id($gig['id']);
                            if(!empty($services)){
                            foreach($services as $service)
                            {
                                echo '<br>';
                                echo '<h5>' . $service['name'] .'</h5>';
                                echo $service['status']. '<br>';
                                ?>
                                <form id='addGigstrForm'  class='form' action="../Private/register.php" enctype="multipart/form-data" method="post"> 
                                    <label class='label' for="ststus">Ändra status 
                                    <select name="status">
                                    <option value="">Välj ett status</option>

                            <option value="I Progress">I progress</option>
                            <option value="Klart">Klart</option>


                            </select>
                                        <input type="hidden" name="gigId" value="<?php echo $gig['id']; ?>">


                                        
                                        <input id='subm' type="submit" name="changeStatus" value="Submit">
                                        
                                        </form>

                            <?php

                            }
                            }
                            
                            
                            }
                            }
                         }else{
                            $shifts = '';
                        }

                                    ?>

                        </div>
                    </div>
                </div>
                
                <!---------- Extra Tjänster Slut --------->   
                
                <!--------- Rapporter ------------>
                
                

                <!--------- Rapporter Slut ------------>                              

            </div>
           

        </div>
    </div>


</div>


<script>
    function myFunction() {
  confirm("are you sure?!");
  
}
function deleletconfig(){

var del=confirm("Are you sure you want to delete this record?");
if (del==true){
   window.alert("record deleted");
}else{
    del == false;
}
return del;
}
</script>
<script type="text/javascript">
    $(".removeImage").click(function(){
        var id = $(this).parents("tr").attr("id");

        if(confirm('Are you sure to remove this record ?!'))
        {
            $.ajax({
               url: 'deleteAccount.php',
               type: 'GET',
               data: {contactNr: id},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).fadeOut(1000);
                    //alert("Record removed successfully");  
               }
            });
        }
    });
    $(".removeGigtr").click(function(){
        var gigstrid = $(this).parents("tr").attr("id");
var gig = $(this).attr("id");
        if(confirm('Are you sure to remove this record ?!'))
        {
            $.ajax({
               url: 'removeGigstr.php',
               type: 'GET',
               data: {gigstrNr: gigstrid,
                      gigNr: gig},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+gigstrid).fadeOut(1000);
                    setInterval('location.reload()', 1000);
               }
            });
        }
    });
    $(".removePDF").click(function(){
        var gig = $(this).parents("tr").attr("id");
var PDF = $(this).attr("id");
        if(confirm('Are you sure to remove this record ?!'))
        {
            $.ajax({
               url: 'removePDF.php',
               type: 'GET', 
               data: {PDF: PDF,
                      gigNr: gig},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+gig);
                    setInterval('location.reload()', 1000);
               }
            });
        }

    });
    $(".removeReport").click(function(){
        var gig = $(this).parents("tr").attr("id");
var report = $(this).attr("id");
        if(confirm('Are you sure to remove this record ?!'))
        {
            $.ajax({
               url: 'removeReport.php',
               type: 'GET', 
               data: {report: report,
                      gigNr: gig},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+gig);
                    setInterval('location.reload()', 1000);
               }
            });
        }

    });



</script>






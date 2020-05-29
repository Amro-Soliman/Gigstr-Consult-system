<?php
include('../Assets/clientHeader.php');
$src = "../images/Delete.svg";
        $srcc = "../images/Edit.svg";
?>

<div id='kundkort-main'>
<div id='cHeader'>
<?PHP 
$contacts = get_contacts_by_client_id($result['id']);
$gigs = get_gigs_by_client_id($_SESSION['clientId']);

    echo '<br>';
   
?>

<?php //echo $msg; ?>
 
<div class="skffa-gig">
      <!--  <a href='createGig.php?id=<?php echo $result["id"]; ?>'> Skapa gig</a> -->
    </div>

    <div class="kund-gig">
       
        <?php 
        if($gigs) {
         foreach($gigs as $gig) {
             if(isset($gig['id'])){
              $shifts = get_shifts_by_gig_id($gig['id']);
              //var_dump($shifts);
           
              echo   $gig['gigName'] . '</br>';

      
              if(isset($shifts)){
              foreach($shifts as $shift) {

               
                

        $_SESSION['shift_id'] = $shift['id'];
         $rawDate1 = strtotime($shift['start_at']);
         $gigDate1 = date('j-M-Y' ,$rawDate1);
         $finaldate1 = explode("-", $gigDate1);
         $rawDate2 = strtotime($shift['finish_at']);
         $gigDate2 = date('j-M-Y' ,$rawDate2);
         $finaldate2 = explode("-", $gigDate2);
         $date =date("Y-m-d");
         
             $shiftsPersons = get_shift_persons_by_gig_id( $shift['id']);
        //  $allPersons = get_persons_worked_for_client_by_shift_id($shift['id']);
         
        
        //  $shifts = get_shift_persons_by_gig_id( $shift['id']);
        //  $allPersons = get_persons_worked_for_client_by_shift_id($shift['id']);
        //  var_dump($allPersons);



              //echo  count($gigsPersons);
    // echo   $gig['gigName'] . '</br>';
    echo   $shift['name'] . '</br>';

    //echo 'Gig plats: ' . $gig['place'] . '</br>';
    if(isset($shifts['result'])) { 
    
      echo   '<p> bokade gigstr '.   0 . ' Av ' . $shift['gigstrNr']  . '</p>';

  // }elseif(count($gigsPersons == 1 )) {
  //     var_dump($gigsPersons);
  //    // $gigsPersons = 0;
  //    echo   '<p> bokade gigstrs '.   count($gigsPersons)   . ' Av ' . $gig['gigstrNr']  . '</p>';


  //     // echo   '<p> bokade gigstr '.  50  . ' Av ' . $gig['gigstrNr'] . '</p></br>';

  // }
  }else{
      echo   '<p> bokade gigstrs '.   count($shiftsPersons)   . ' Av ' . $shift['gigstrNr']  . '</p>';

      echo '';
  }
  if(isset($shiftsPersons)) {
    echo  '<table class="gigstr-list">';

    foreach($shiftsPersons as $shiftPerson){
        
        if(isset($shiftPerson['gigstr_id'])){
            

        $gigstrs = get_gigstr_by_id($shiftPerson['gigstr_id']) ?? '';
       // var_dump($gigstrs);
        if(isset($gigstrs)) {
         

       echo "<tr id='$gigstrs[id]' >".'<td> '. "<img   src=../images/" . $gigstrs["file_name"].  ">" . '</td>' . '<td>'.  '<p>'   .$gigstrs['name'] .   '</p>' . '</td>' . '<td>'                         . '</td>'
       . '</tr>';
       echo "<td> $gigstrs[description]";
       $type = like_unlike_exists($shiftPerson['gigstr_id'], $_SESSION['clientId']);


       ?>
       <div class="post-action">

<!-- <input type="button" value="Like" id="like_<?php echo $gigstrs['id']; ?>" class="like" style="<?php   if($type == 1) { echo "color: #ffa449;"; } ?>" />&nbsp;(<span id="likes_<?php //echo $postid; ?>"><?php //echo //$total_likes; ?></span>)&nbsp; -->

<!-- <input type="button" value="Unlike" id="unlike_<?php echo $gigstrs['id']; ?>" class="unlike" style="<?php if($type ==  0){ echo "color: #ffa449;"; }else{} ?>" />&nbsp;(<span id="unlikes_<?php //echo $postid; ?>"><?php //echo //$total_unlikes; ?></span>) -->
    <img src='../images/heartliked.svg'   id="like_<?php echo $gigstrs['id']; ?>" class="like" style="<?php   if($type == 1) { echo "color: #ffa449;"; } ?>" >

<img src='../images/heartbroken.svg' id="unlike_<?php echo $gigstrs['id']; ?>" class="unlike" style="<?php if($type ==  0){ echo "color: #ffa449;"; }else{} ?>" >
</div>
<?php

     
       // echo $gigstrs['name'];
              }  

                }    //    echo "<img  src=../images/" . $gigstrs["file_name"].  ">";
           
    }
    
    }
    

  



}
}}}

  //  echo   '<p>'.  count($gigsPersons) . ' Av ' . $gig['gigstrNr'] . '</p>';

    //echo 'Antal gigstr: ' . $gig['gigstrNr'] . '</br>';
    //echo 'Datum: ' . $finaldate[0] . " " . $finaldate[1] . " " . $finaldate[2] ." " .'</br>';
    //echo  '<h4>Gigstrs</h4>';
    echo  '<div class="bokade-gigstrs">';
    //echo '<a href=' . "gigstrBokning.php?gigId=$gig[id]&client=$result[id]>" .'Lägg till gigstr </a>';
    ?>
    <table class="gigstr-list">
  <tr>
<!-- <th>Gigstrs</th> -->
</tr>

<?php


    echo    '<div class="antal-gigstrs">';

    //echo   '<p>'.  count($gigsPersons) . ' Av ' . $gig['gigstrNr'] . '</p>';
    //echo    '<p>av</p>';
    echo   '</div>';
    echo '<div class="kundkort-hide">';
             //   <img src="#">
    echo  '</div>';
    echo  '</div>';
    echo  '</div>';

    echo  '<div class="gig-hidden">';
    //echo  '<p>Tom mapp</p>';
    echo   '<h3> <a></a></h3>';
    echo  '<div>';
    echo '<table></table>';
    echo   '</div>';
    echo  '</div>';
    echo '</div>';
    

}
$allPersons = get_persons_worked_for_client_by_shift_id($_SESSION['clientId']);

// var_dump($allPersons);

//   var_dump($allPersons);
//   var_dump($working);



// if(isset($shifts)){

    echo '<h3>Personer från avklarade gig</h3>';
    // foreach($shifts as $shift) {

        $date =date("Y-m-d");


        // if($date < $shift['shift_date']){
            // echo $shift['shift_date'];
    // foreach($shifts as $shift) {
        

 echo  '<table class="gigstr-list">';

  
//   if(isset($allPersons)){

  foreach($allPersons as $person){
    // $allPersons = get_persons_worked_for_client_by_shift_id($_SESSION['clientId'], $person['shift_date']);
// var_dump($allPersons);
  $working =    get_gigstrs_by_id($person['gigstr_id']);
  
  

foreach($working as $work){
  
    echo "<tr id='$work[id]' >".'<td> '. "<img   src=../images/" . $work["file_name"].  ">" . '</td>' . '<td>'.  '<p>' .$work['name'] .  '</p>' . '</td>' . '<td>'                         . '</td>'
    . '</tr>';
    echo '</table>';
   
  }
}


  

$result = get_liked_gigstrs_by_client_id($_SESSION['clientId']);
if(isset($result)){
    echo 'de likade';
    echo  '<select>';

foreach($result as $rslt){
  $likedGigsters=  get_gigstrs_by_id($rslt['gigstr_id']);
  foreach($likedGigsters as $likedGigster) {
    if(isset($likedGigster['id'])){

    echo "<tr id='$likedGigster[id]' >".'<td> '. "<img   src=../images/" . $likedGigster["file_name"].  ">" . '</td>' . '<td>'.  '<p>' .$likedGigster['name'] .  '</p>' . '</td>' . '<td>'                         . '</td>'
    . '</tr>';
    echo  '</table>';


    echo "<option value='$likedGigster[name]'>" . " $likedGigster[name]  </option>";


  
  }else{
        $likedGigster = '';
  }}
}
}
echo '</select>';



// get_gigstrs_by_id($person['gigstr_id']);
//$gigsPersons = get_gig_persons_by_gig_id( $gig['id']);
//var_dump($gigsPersons);


        ?>
    </div> 

   
</div>

<script>
//   var imgBtn = document.querySelector('#profilePicture');
// var fileInp = document.querySelector('[type="file"]');
// var button = document.querySelector('[type="submit"]');
// imgBtn.addEventListener('click', function() {
//   fileInp.click();
  

// })
$(document).ready(function(){

// like and unlike click
$(".like, .unlike").click(function(){
    var id = this.id;   // Getting Button id
    var split_id = id.split("_");

    var text = split_id[0];
    var gigstrid = split_id[1];  // postid

    // Finding click type
    var type = 0;
    if(text == "like"){
        type = 1;
    }else{
        type = 0;
    }

    // AJAX Request
    $.ajax({
        url: 'likeunlike.php',
        type: 'post',
        data: {gigstrid:gigstrid,type:type},
        dataType: 'json',
        success: function(data){
            var likes = data['likes'];
            var unlikes = data['unlikes'];
            

            $("#likes_"+gigstrid).text(likes);        // setting likes
            $("#unlikes_"+gigstrid).text(unlikes);    // setting unlikes

            if(type == 1){
                $("#like_"+gigstrid).css("color","#ffa449");
                $("#unlike_"+gigstrid).css("color","lightseagreen");

            }

            if(type == 0){
                $("#unlike_"+gigstrid).css("color","#ffa449");
                $("#like_"+gigstrid).css("color","lightseagreen");
                
            }
            

        }
        
    });

});

});
</script>




<?php
include('../Assets/clientHeader.php');
$gigs = get_gigs_by_client_id($_SESSION['clientId']);
                $services = get_services_by_gig_id($gig['id']);

        if($gigs) {
         foreach($gigs as $gig) {
             if(isset($gig['id'])){
                $gigsPersons = get_gig_persons_by_gig_id( $gig['id']);

             }else{
                 $gigsPersons = '';
             }
           // echo $gig['id'];
            //$gigstrs = get_gigstr_by_id($id);
 //var_dump($gigsPersons);
            $rawDate = strtotime($gig['gigDate']);
            $gigDate = date('j-M-Y' ,$rawDate);
            $finaldate = explode("-", $gigDate);
              //echo  count($gigsPersons);
    echo   $gig['gigName'] . '</br>';
    //echo 'Gig plats: ' . $gig['place'] . '</br>';
    if(isset($gigsPersons['result'])) { 
    
      echo   '<p> bokade gigstr '.   0  . ' Av ' . $gig['gigstrNr']  . '</p>';

  // }elseif(count($gigsPersons == 1 )) {
  //     var_dump($gigsPersons);
  //    // $gigsPersons = 0;
  //    echo   '<p> bokade gigstrs '.   count($gigsPersons)   . ' Av ' . $gig['gigstrNr']  . '</p>';


  //     // echo   '<p> bokade gigstr '.  50  . ' Av ' . $gig['gigstrNr'] . '</p></br>';

  // }
  }else{
      echo   '<p> bokade gigstrs '.   count($gigsPersons)   . ' Av ' . $gig['gigstrNr']  . '</p>';

      echo '';
  }
  //  echo   '<p>'.  count($gigsPersons) . ' Av ' . $gig['gigstrNr'] . '</p>';

    //echo 'Antal gigstr: ' . $gig['gigstrNr'] . '</br>';
    //echo 'Datum: ' . $finaldate[0] . " " . $finaldate[1] . " " . $finaldate[2] ." " .'</br>';
    echo  '<div ' . ' id="gig-gigstrs" class=' . "gig-extra>";
    echo '<div>';
    //echo  '<h4>Gigstrs</h4>';
    echo  '<div class="bokade-gigstrs">';
    //echo '<a href=' . "gigstrBokning.php?gigId=$gig[id]&client=$result[id]>" .'Lägg till gigstr </a>';
    ?>
    <table class="gigstr-list">
  <tr>
<!-- <th>Gigstrs</th> -->
</tr>
<?php
if(isset($gigsPersons)) {
    foreach($gigsPersons as $gigPerson){
        if(isset($gigPerson['gigstr_id'])){


        $gigstrs = get_gigstr_by_id($gigPerson['gigstr_id']) ?? '';
       // var_dump($gigstrs);
        if(isset($gigstrs)) {


       echo "<tr id='$gigstrs[id]' class="."$gig[gigstrNr]>". '<td> '.'<td> '. "<img   src=../images/" . $gigstrs["file_name"].  ">" . '</td>' . '<td>'.  '<p>' .  '<a class="clientListLinks" href='  . 'gigstrProfile.php?id=' . $gigstrs['id']  . '>' .$gigstrs['name'] . '</a>' .  '</p>' . '</td>' . '<td>'                         . '</td>'
       . '</tr>';
       echo "<td> $gigstrs[description]"; 

       // echo $gigstrs['name'];
              }  
                }    //    echo "<img  src=../images/" . $gigstrs["file_name"].  ">";
                $services = get_services_by_gig_id($gig['id']);
                if(!empty($services)){
                foreach($services as $service)
                {echo $service['name']. '<br>';
                  echo $service['status']. '<br>';

                   // echo '<p>'. "<a ". "target=" .'_blank '. "href=" . "../uploads/$pdf[PDF_content]>" . $pdf['PDF_content'] . '</a>' .'</p>' ;
                }
                }
    }
    }
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
}
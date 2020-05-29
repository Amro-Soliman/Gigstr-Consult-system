<?php
include('../Assets/clientHeader.php');
$gigs = get_gigs_by_client_id($_SESSION['clientId']);
$shifts = get_shifts_by_client_id($_SESSION['clientId']);


// print_r($shifts);
?>
<div id='kundkort-main'>

  <div class='calender-shift-wrapper'>
    <?php
      echo '<h4> Dina kommande gig</h4>';

      if($gigs) {
                    foreach($gigs as $gig) {
                      if(isset($gig['id'])){
    ?>
    <div class=shift-datum-wrapper>
          <?php

            
        $prob = get_shifts_by_gig_id($gig['id']);
      print_r($prob);
      $array2 = array_unique($prob);
      print_r($prob);

        foreach($prob as $prb){
          ?>
        <div class="shift-datum-info"> 
            <?php
                 echo  $prb['shift_date'];
                   ?>
        </div>

        <div class="shift-container">
          <?php
          echo $prb['place']. '<br>';
          echo $prb['start_at']. '<br>';
          echo $prb['finish_at']. '<br>';
          }
              ?> 
              
        </div>
    </div>           

  
  </div>
    <?php
    // if($shifts){




      
    //   foreach($shifts as $shift){



      
    //     $shiftPersons = get_shift_persons_by_gig_id($shift['id']);

       
    //     echo $shift['shift_date']. '<br>';

    //     echo $shift['name']. '<br>';
    //     echo $shift['place']. '<br>';
    //     echo $shift['start_at']. '<br>';
    //     echo $shift['finish_at']. '<br>';
    //     foreach($shiftPersons as $shiftPerson){
    //       if(isset($shiftPerson['gigstr_id'])){
    //       $working =    get_gigstrs_by_id($shiftPerson['gigstr_id']);
          
        
    //     foreach($working as $work) {
    //     echo "<img class=img  src=../images/" . $work["file_name"]. " title='$work[name]'/>";

        
    //     }
    //   }
    //   }
        // var_dump($shiftPersons);
        // var_dump($working);


     // }
      function filterArray($value){
        return ($value == 'shift_date');
      }
        $filteredArray = array_filter($shifts, 'filterArray');
        foreach($filteredArray as $k => $v){
          echo "$k = $v";
      
  
    }
    var_dump($filteredArray);
    }

    
    foreach (array_keys($shifts) as $key) {
      if ($shifts[$key] = 2)  {
          unset($shifts[$key]);
      }
  }



  ?>
  <div class='extra-tjanster-wrapper'>
  <?php
  echo '<h4> Exstra tjänster status</h4>';

         
            

  
                        $services = get_services_by_gig_id($gig['id']);
                        if(!empty($services)){
                        foreach($services as $service)
                        {echo $service['name']. '<br>';
                          echo $service['status']. '<br>';

                          // echo '<p>'. "<a ". "target=" .'_blank '. "href=" . "../uploads/$pdf[PDF_content]>" . $pdf['PDF_content'] . '</a>' .'</p>' ;
                   //     }
                        }
            }
            }
?>

  
</div>
   <?php

//     $group = [];
// foreach ($shifts as $item)  {
//     if (!isset($group[$item['shift_date']])) {
//         $group[$item['shift_date']] = [];
//     }
//     foreach ($item as $key => $value) {
//         if ($key == 'shift_date') continue;
//         $group[$item['shift_date']][$key] = $value;
//     }
// }
// print_r($group);



// $array1 = array('name' => null, 'name' => null, 'place' => null);
// $array2 = array();

// array_walk($shifts, function ($v) use (&$array2, $array1) {
//     $a = $v['shift_date'];
//     if (!isset($array2[$a])) {
//         $array2[$a] = $array1;
//     }
//     unset($v['shift_date']);
//     $array2[$a] = array_merge($array2[$a], $v);
// });

// print_r($array2);
    // var_dump($shiftPersons);
    //echo   '<p>'.  count($gigsPersons) . ' Av ' . $gig['gigstrNr'] . '</p>';
    //echo    '<p>av</p>';
    
    


   
}

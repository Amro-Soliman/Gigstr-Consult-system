<?php
include('../Assets/clientHeader.php');
$id = $_SESSION['clientId'];
$gigs = get_gigs_by_client_id($_SESSION['clientId']);
//var_dump($gigs);
?>
<div id='kundkort-main'>
<?php
foreach($gigs as $gig) {
if($gig){
      echo $gig['gigName']. '<br>';

}
//   echo $gig['gigName'];
$pdfs = get_offers_by_client_id($gig['id']);
                                if($pdfs){
                                foreach($pdfs as $pdf){
                                    
                                echo '<table>';
                            
                                echo "<tr id='$gig[id]'>" . '<td>' . "<a ". "target=" .'_blank '. "href=" . "../uploads/$pdf[offer]>" . $pdf['offer'] . '</a>' . '</td>' . '<td>' .  '<img class='. 'removePDF ' . 'id='.  $pdf['id']    .   '>'                     . '</td>'
                                    . '</td>'.'</tr>';
                                    echo '</table>';
                                }}else{
                                    $pdf = '';
                                }


    
    // foreach($pdfs as $pdf){
    //     echo '<p>'. "<a ". "target=" .'_blank '. "href=" . "../uploads/$pdf[PDF_reports]>" . $pdf['PDF_reports'] . '</a>' .'</p>' ;
    // }
    
    

}
?>

<div id='kundkort-main'>

</div>
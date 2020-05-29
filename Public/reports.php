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
}
   $reports = get_pdf_reports_by_client_id($gig['id']);
                                if($reports){
                                foreach($reports as $report){
                                    
                                echo '<table>';
                            
                                echo "<tr id='$gig[id]'>" . '<td>' . "<a ". "target=" .'_blank '. "href=" . "../uploads/$report[PDF_reports]>" . $report['PDF_reports'] . '</a>' . '</td>' . '<td>' .  '</tr>';
                                    echo '</table>';
                                }}else{
                                    $report = '';
                                }
                            
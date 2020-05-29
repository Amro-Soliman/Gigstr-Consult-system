<?php
include('../Assets/clientHeader.php');
?>

<div id='kundkort-main'>
<div id='cHeader'>
<?PHP 
$contacts = get_contacts_by_client_id($result['id']);
$gigs = get_gigs_by_client_id($_GET['id']);

    echo '<br>';
    $varu = ucfirst($companyName);
    $var = substr($varu, 0, 1) . '.';
    ?>
    <div id='logo'> <?php echo $var; ?> </div>
<form action="../Private/upload.php" method="post" enctype="multipart/form-data">
<input type="file" name='image' />
<input type="submit" value="Upload Image" name="submit" style="position: absolute;left: -137px;top: 107px;">
</form>

    <img src='../Unknown.png'  id='profilePicture' alt='Profile Picture'>
    <h2> <?php echo $result['companyName'] . '</br>'; ?> </h2>
    <p> <?php  echo $result['companyAdress'] . '</br>'; ?> </p>
    


</div>

<div id='contact'>
  
<h5>Kontakt person(er)</h5><br><br>

</div>
<?php
echo '<div id="contactInfo">'; 
echo '<hr><br>' ;
echo '<p>' . $result['firstName'] . '&nbsp;' . $result['lastName'] . '<span class="spanMail">' . $result['email'] . '</span>' . '<span id="spanTel">' . $result['tel'] . '</span>' . '</p><br>'  ;
echo '<hr><br>' ;
if($contacts) {
foreach($contacts as $contact) {
  echo '<p>' . $contact['firstName'] . '&nbsp;' . $contact['lastName'] . '<span class="spanMail">' . $contact['email'] . '</span>' . '<span id="spanTel">' . $contact['tel'] . '</span>' . '</p><br>'  ;
}
}else{
  $contacts = '';

}
//var_dump($contact);
//echo '</div>';

echo '</div>';
?>

<?php //echo $msg; ?>


</div>
<script>
  var imgBtn = document.querySelector('#profilePicture');
var fileInp = document.querySelector('[type="file"]');
var button = document.querySelector('[type="submit"]');
imgBtn.addEventListener('click', function() {
  fileInp.click();
  

})
</script>




<?php
include('../Assets/clientHeader.php');
$result = get_liked_gigstrs_by_client_id($_SESSION['clientId']);
$contacts = get_contacts_by_client_id($_SESSION['clientId']);
$client = get_client_by_id($_SESSION['clientId']);
?>
  <div id='kundkort-main'>

<?php

if(isset($_get['id'])) {
echo $_get['id'];}
?>  
<div id='contactPerson'>
        <h1 id='contactHelp'> Lägg till ett shift</h1>

        <form class='form' action="bokaGig.php" method="post">
        <select name='choise' >
        <option value="Välj ett val">Välj ett val</option>

        <option value="Event Personal">Event Personal</option>
        <option value="Demo Personal">Demo Personal</option>
        <option value="Försäljning">Försäljning</option>
  </select>
  <?php
  if(isset($result)){
      ?>
    <p>Favorita gigstrs</p>
    <select name='favoriteGigstrs[]' multiple>
    <option value="Välj ett val">Välj en gigstr</option>
<?php
foreach($result as $rslt){
  $likedGigsters=  get_gigstrs_by_id($rslt['gigstr_id']);
  foreach($likedGigsters as $likedGigster) {
    if(isset($likedGigster['id'])){

    // echo "<tr id='$likedGigster[id]' >".'<td> '. "<img   src=../images/" . $likedGigster["file_name"].  ">" . '</td>' . '<td>'.  '<p>' .$likedGigster['name'] .  '</p>' . '</td>' . '<td>'                         . '</td>'
    // . '</tr>';
    // echo  '</table>';


    echo "<option value='$likedGigster[name]'>" . " $likedGigster[name]  </option>";


  
  }else{
        $likedGigster = '';
  }}
}
}
echo '</select>';
echo '</br>';

if(isset($contacts)){
    ?>
  <p>Favorita gigstrs</p>
  <select name='contacts'>
  <option value="Välj en Kontaktperson">Välj en gigstr</option>
<?php
foreach($contacts as $contact){

  if(isset($contact['id'])){

  // echo "<tr id='$likedGigster[id]' >".'<td> '. "<img   src=../images/" . $likedGigster["file_name"].  ">" . '</td>' . '<td>'.  '<p>' .$likedGigster['name'] .  '</p>' . '</td>' . '<td>'                         . '</td>'
  // . '</tr>';
  // echo  '</table>';


  echo "<option value='$contact[firstName] $contact[lastName] '>  $contact[firstName] $contact[lastName]  </option>";



}else{
      $contact = '';
}}
}

?>
            <label  class='label' for="gigstrNr">Antal gigstrs
            <input class='input' type="text" name="gigstrNr"> </label></br></br>
           
            <label class='label' for="comment">Beskriv ditt behöv: </br>
            <textarea class='input' id='description'  name="comment"></textarea> <div id='output'></div>  
</label> </br></br>
            <input class='label' type='hidden' name='id' value='<?php echo $_SESSION["client_id"]; ?>'>

            
            
            <br>
            <input id='subm' type="submit" name="gigBooking" value="Submit">
            </form>
            </div>
    </div>
    </div>
    <?php
    // if($result){
        $clientCompany= $client['companyName'];
        echo $clientCompany;
        if(isset($_POST['gigBooking'])){
            $clientCompany= $client['companyName'];
            echo $clientCompany;
            $respContact = $_SESSION['respContacts'] = $_POST['contacts'];

            $choise = $_SESSION['choise'] = $_POST['choise'];
            $favoritegigs = $_SESSION['favoriteGigstrs'] =$_POST['favoriteGigstrs'];
            $clientContacts = $_SESSION['contacts'] =$_POST['contacts'];

            $gigstrNr = $_SESSION['gigstrNr'] = $_POST['gigstrNr'];
            $request = $_SESSION['comment'] = $_POST['comment'];
            $to      = 'radik@gigstr.com';
            $subject = 'Testar data som kommer från formuläret.';
            $message = '';
            $message .= 'hello,'  .PHP_EOL  . PHP_EOL. 'it is me Amro testing the form and its data if i can send it to mail which seems to work ,'. PHP_EOL .'';
            $message .= 'This message can end up in spam folder' .PHP_EOL .'';
            $message .= $choise . PHP_EOL . ''; 
            $message .= $request . PHP_EOL .''; 


           
        foreach($favoritegigs as $favoritegig) {

            $favoriteGigtrs =$_SESSION['favoritegig'] = $favoritegig;
            $message.=  $favoriteGigtrs . PHP_EOL . '';

        }  
        

            $message.=  $respContact . PHP_EOL . '';

        

            $message .= $gigstrNr . PHP_EOL . ''; 
            $message .= $clientCompany;

            $headers = 'From: Wel3m4St3R@gigstr.com' . "\r\n" .
            'Reply-To: webmaster2@gigstr.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
    }
          
            

            // echo $favoriteGigtrs;


 


?> 

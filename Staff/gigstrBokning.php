<?php
include('Assets/staffHeader.php');
$info = get_all_gigstrs();
//if(isset($_GET['id'])){
//$results = SearchGigstrs($_GET['id']) ?? '';
          // var_dump($results);
       //  echo 'yes' . "</br>";
       // echo '<h2 id="sok"> Sök Resultat. </h2>';
      
        //echo '<div id="searchResult">';
       // foreach($results as $result) {
        //echo '<p class="test">' .  '<a href='  . 'gigstrProfile.php?id=' . $result['id']  . '>' . $result['name'] .    '</a>' .  '</p>' .'</br>';
      //  }
              
      //}
      if(isset($_GET['client'])){
       $_session['clientID']=  $_GET['client']  ?? ''; 
       $_SESSION['shiftID']=  $_GET['shiftId'] ?? '';   }
?>
<!-- c -->
<div id='kundkort-main'>
<a id="lank" href="clientProfile.php?id=<?php echo $_session['clientID']; ?>">back</a>

<a id="lank" href="addGigstr.php">Add gigstr</a>
<form id='clientSearch'action='gigstrBokning.php' method='get'>
<input type='text' id='search4' name='id' >
<input type='hidden' name='shiftId' value="<?php echo $_SESSION['shiftID']; ?>">
<input type='hidden' name='client' value="<?php echo $_session['clientID'] ; ?>">
<input type='hidden' name='date' value="<?php echo $_SESSION['shift_date'] ; ?>">


<input id='submitb' type='submit' name='submit' value='Sök'>
</form>
<div id="display"></div>
<div id='main'>
<?php


if(isset($_GET['id'])){
$results = SearchGigstrs($_GET['id']) ?? '';
           //var_dump($results);
         //echo 'yes' . "</br>";
        echo '<h2 id="sok"> Sök Resultat. </h2>';
      
        echo '<div id="searchResult">';
        ?>
       <!-- <a id="lank" href="clientProfile.php?id=<?php echo $_GET['client']; ?>">back</a> -->
<?php
        ?>
        <table class="gigstr-list">
  <tr>
<th>Gigstrs</th>
</tr>
<?php
if($results)
        foreach($results as $result) {
          $imageURL2 = '../images/'.$result["file_name"];
          if(booking_exists($result['id'],$_SESSION['shiftID'] )){

        echo '<tr>' . '<td> <img' . " src=$imageURL2 </img>". '</td>'. '<td>' . '<p>' . '<a href='  . 'gigstrProfile.php?id=' . $result['id']  . '>' . $result['name'] .    '</a>' .  '</p>' . '</td>' . '<td>' . '<p class=warrning-noti>'  . 'Bokad' .  '</p>' . '</td>'.  '</br>';
        }else{
          echo '<tr>' . '<td> <img' . " src=$imageURL2 </img>". '</td>'. '<td>' . '<p>' . '<a href='  . 'gigstrProfile.php?id=' . $result['id']  . '>' . $result['name'] .    '</a>' .  '</p>' . '</td>' . '<td>' . '<div class=success-noti>' .  '<a  class="booking" href='  . 'bokning.php?id=' . $result['id']  .'&shiftId='. $_SESSION['shiftID'] . '&client=' . $_session['clientID'].'>' . 'Boka' . '</a>' .  '</div>' . '</td>'.  '</br>';
        }
      }
              
      }

?>

<table class="gigstr-list">
  <tr>
<th></th>
</tr>
<?php foreach($info as $inf) { 
  $imageURL = '../images/'.$inf["file_name"];

 //echo '<p>' .  '<a class="clientListLinks" href='  . 'gigstrProfile.php?id=' . $inf['id']  . '>' . $inf['gigstrName'] . '</a>' .  '</p>';
//echo '<tr>' .'<td> <img' . " src=$imageURL </img>". '<td>' . '<p>' .  '<a class="clientListLinks" href='  . 'gigstrProfile.php?id=' . $inf['id']  . '>' . $inf['name'] . '</a>' .  '</p>' . '</td>' . '<td>' . '<p>' .  '<a class="clientListLinks" href='  . 'bokning.php?id=' . $inf['id']  .'&gigId='. $_GET['gigId'] .'>' . 'Boka' . '</a>' .  '</p>' . '</td>' . '</tr>';
} 
  echo '</div>';
  echo '</table>' 
	
  // To do:
  // 1- ta bort profillänker från personal.php
  // 2- om man är bokad så blir det till Bokad.
  // 3- Favorite knapp bredvid gigsters i avk. Gig.
  // 4- På front-end så ska vi ha BOKA GIG:
  //      1- dropdown med 3 val, Event personal, demo personal, försäljning.
  //    2- Antal gigstrs.
  //   3- dropdown med dem favorita.
  //   4- Text Area med ditt behöv.
  //   5- Boka gig knapp.
  //   6- med. Efter bokningen är klar.
  // 5- Bilder under rapporter.
  // 6- kolla på JS klipp från Radik.
  
  ?>
</div>

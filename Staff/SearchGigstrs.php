<?php
include('Assets/staffHeader.php');
if(isset($_GET['id'])) {
?>

<div class="search-field">
<form id='clientSearch'action='SearchGigstrs.php' method='get'>
  <input type='text' id='search4' name='id' >
  <input id='submitb' type='submit' name='submit' value='Sök'>
  </form>
</div>

<?php



  // gets value sent over search form
   //echo $query;
      $results = SearchGigstrs($_GET['id']);
           var_dump($results);
         echo 'yes' . "</br>";
        echo '<h2 id="sok"> Sök Resultat. </h2>';
      
        echo '<div id="searchResult">';
        foreach($results as $result) {
        echo '<p class="test">' .  '<a href='  . 'gigstrProfile.php?id=' . $result['id']  . '>' . $result['name'] .    '</a>' .  '</p>' .'</br>';
        }
              echo "<h3>" . $result['id'] . "</h3>";
}elseif(isset($_GET['id'])) {
  $results = SearchGigstrs($_GET['id']);
  var_dump($results);
echo 'yes' . "</br>";
echo '<h2 id="sok"> Sök Resultat. </h2>';

echo '<div id="searchResult">';
foreach($results as $result) {
echo '<p class="test">' .  '<a href='  . 'gigstrProfile.php?id=' . $result['id']  . '>' . $result['name'] .    '</a>' .  '</p>' .'</br>';
}
     echo "<h3>" . $result['id'] . "</h3>";
}
         ?>
         <div id='kundkort-container'>
      
<?php
     ?>

 


</div>
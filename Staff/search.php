<?php
include('Assets/staffHeader.php');
?>
<div id='kundkort-main'>
  
  <div class="search-field">
    <form id='clientSearch'action='search.php' method='post'>
    <input type='text' id='search4' name='search' >
    <input id='submitb' type='submit' name='submit' value='Sök'>
    </form>
  </div>
<?php


    $query = $_POST['search']; 
    // gets value sent over search form
     //echo $query;
        $results = Search($query);
             //var_dump($results);
           //if($results);

          //echo 'yes' . "</br>";
          echo '<h2 id="sok"> Sök Resultat. </h2>';
        
          echo '<div id="searchResult">';
          foreach($results as $result) {
          echo '<p class="test">' .  '<a href='  . 'clientProfile.php?id=' . $result['id']  . '>' . $result['companyName'] . '</a>' .  '</p>' .'</br>';
          }
                //echo "<h3>" . //$result['id'] . "</h3>";
?>
</div>


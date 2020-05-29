<?php
include('Assets/staffHeader.php');
$info = get_all_clients();
?>
  <div id='kundkort-main'>
        
  
<form id='clientSearch'action='search.php' method='post'>
<input type='text' id='search4' name='search' >
<input id='submitb' type='submit' name='submit' value='Sök'>
</form>
<div id="display"></div>
<div id='main'>
<table>
  <tr>
<th>Företagsnamn</th>
</tr>
<?php foreach($info as $inf) { 
 //echo '<p>' .  '<a class="clientListLinks" href='  . 'clientProfile.php?id=' . $inf['id']  . '>' . $inf['companyName'] . '</a>' .  '</p>';
echo '<tr>' . '<td>' . '<p>' .  '<a class="clientListLinks" href='  . 'clientProfile.php?id=' . $inf['id']  . '>' . $inf['companyName'] . '</a>' .  '</p>' . '</td>' . '</tr>';
}
  echo '</div>';
  echo '</table>' 
	

  ?></div>
  </div>
<?php
include('Assets/staffHeader.php');
$info = get_all_gigstrs();
?>
<!-- c -->
<div id='kundkort-main'>

<a id="lank" href="addGigstr.php">Add gigstr</a>
<form id='clientSearch'action='searchGigstrs.php' method='get'>
<input type='text' id='search4' name='id' >
<input id='submitb' type='submit' name='submit' value='Sök'>
</form>
<div id="display"></div>
<div id='main'>
<table class="gigstr-list">
  <tr>
<th>Gigstrs</th>
</tr>
<?php foreach($info as $inf) { 
  $imageURL = '../images/'.$inf["file_name"];

 //echo '<p>' .  '<a class="clientListLinks" href='  . 'gigstrProfile.php?id=' . $inf['id']  . '>' . $inf['gigstrName'] . '</a>' .  '</p>';
echo '<tr>' .'<td> <img' . " src=$imageURL </img>". '<td>' . '<p>' .  '<a class="clientListLinks" href='  . 'gigstrProfile.php?id=' . $inf['id']  . '>' . $inf['name'] . '</a>' .  '</p>' . '</td>' . '</tr>';
} 
  echo '</div>';
  echo '</table>' 
	

  ?>
</div>
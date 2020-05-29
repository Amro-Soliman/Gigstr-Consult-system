<?php
include('Assets/staffHeader.php');
$result = '';
$result = get_gigstr_by_id($_GET['id']);
$comments = get_comments_by_gigstr_id($_GET['id']);

$companyName = $result['name'];
//echo $companyName;
?>
  <div id='kundkort-main'>
    <div id='cHeader'>
    <?PHP 
  //  echo '<br>';
    //$varu = ucfirst($companyName);
    //$var = substr($varu, 0, 1) . '.';
    ?>
    <div id='logo'> <?php //echo $var; ?> </div>
    <?php $imageURL = '../images/'.$result["file_name"]; ?>

    <img src='<?php echo $imageURL; ?>'  id='profilePicture' alt='Profile Picture'>
    
    <h2> <?php echo $result['name'] .   '</br>'; ?> </h2>
    <p> <?php  echo $result['city'] . '</br>'; ?> </p>

    <div id="desc">
    <p> <?php  echo $result['description'] . '</br>'; ?> </p>
    </div>




</div>
<div id="str">
<h4> Kontaktuppgifter </h4>
<p> <?php  echo $result['tel'] . '</br>'; ?> </p>
<p> <?php  echo $result['email'] . '</br>'; ?> </p>
</div>

<div id="comment">
<a href="addComment.php?id=<?php echo $result["id"]; ?>">Lägg till en kommentar</a>
<h4> Kommentarer </h4>
<?php
if($comments) { 
 foreach($comments as $comment) { ?>
  
<p> <?php echo $comment['name']; ?> </p>
<p> <?php echo $comment['comment']; ?> </p>
<?php }}else{ ?>
  <p> <?php echo'Inga Kommentar'; ?> </p>

<?php }?>






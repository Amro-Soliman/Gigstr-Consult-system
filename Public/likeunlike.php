<?php

include('../Assets/clientHeader.php');

$clientid = $_SESSION['clientId'];
$gigstrid = $_POST['gigstrid'];
$type = $_POST['type'];

add_like_unlike($gigstrid,$clientid,$type);
// count numbers of like and unlike in post
// $query = "SELECT COUNT(*) AS cntLike FROM like_unlike WHERE type=1 and postid=".$postid;
// $result = mysqli_query($con,$query);
// $fetchlikes = mysqli_fetch_array($result);
// $totalLikes = $fetchlikes['cntLike'];

// $query = "SELECT COUNT(*) AS cntUnlike FROM like_unlike WHERE type=0 and postid=".$postid;
// $result = mysqli_query($con,$query);
// $fetchunlikes = mysqli_fetch_array($result);
// $totalUnlikes = $fetchunlikes['cntUnlike'];

// // initalizing array
// $return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

// echo json_encode($return_arr);

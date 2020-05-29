
<?php
// Logging out script that hendels both loogin outs
// from user and admin.
session_start();
if(isset($_SESSION['clientId'])) {
unset($_SESSION['clientId']);
session_destroy();
header("Location: ../Public/loginForm.php");
exit;
}elseif(isset($_SESSION['userId'])){
    unset($_SESSION['userId']);
    session_destroy();
    
    header("Location: ../Staff/loginPage.php");
    exit;
}else{
    echo "ERROR 404";
}
?>
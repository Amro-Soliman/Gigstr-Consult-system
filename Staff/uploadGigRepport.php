<?php
include('Assets/staffHeader.php');

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
    $target_dir = "../uploads/";

    $gigId = $_POST['gigId'];
    $fileName = $_FILES['userfile']['name'];
    $target_file = $target_dir . basename($fileName);
    $tmpName  = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];
    $uploadOk = 1;

    $allowed =  array('pdf');
$ext = pathinfo($fileName, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
    echo 'Please, only upload PDF files';
}
    $fp      = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);
    
    if(!get_magic_quotes_gpc())
    {$date =date("Ymd");
        $fileName = addslashes($fileName);
        if (move_uploaded_file($tmpName ,  $target_file )) {
            //         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
           
    }
}
    
    if(add_offers($gigId, $fileName)){
    echo "<br>File $fileName uploaded<br>";
    }else{
        echo 'no';
    }
    }


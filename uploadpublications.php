<?php
session_start();
$target_dir = "uploads/";
if(isset($_POST["biburl"]) && !empty($_POST["biburl"])) {
    // Initialize a file URL to the variable 
    $url = $_POST["biburl"]; 
    
    // Use basename() function to return the base name of file  
    $file_name = basename($url); 
    
    // Use file_get_contents() function to get the file 
    // from url and use file_put_contents() function to 
    // save the file by using base name 
    if(file_put_contents( $target_dir . "/" . $file_name,file_get_contents($url))) { 
        echo "File downloaded successfully"; 
        $_SESSION['filename'] = $target_dir . "/" . $file_name;
        include 'feed-mysql.php';
    } 
    else { 
        echo "File downloading failed."; 
        header('Location: uploadpublications.php');
    } 
}
else if(!empty($_FILES['upfile'])){
    print_r("Hee");
    $target_file = $target_dir . basename($_FILES["upfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["upfile"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "bib" ) {
        echo "Sorry, only bib files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["upfile"]["name"]). " has been uploaded.";
        $_SESSION['filename'] = $target_file;
        include 'feed-mysql.php';

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }
}
?>
<?php
ini_set('display_errors', 1);
   if (isset($_GET['term'])){
        $return_arr = array();
   }

    try {
        $username = "root";
        $pass = "samael";
        //$link = mysqli_connect("localhost", "root", "samael", "psdsv");
        $conn = new PDO("mysql:host=localhost;dbname=psdsv", $username, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $stmt = $conn->prepare('SELECT name, surname FROM users WHERE role="publisher" AND surname LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%')); 
        
        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['surname'] . ' ' .  $row['name'][0] . '.' ;
        }
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
    
?>
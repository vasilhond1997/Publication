<?php 
    if (isset($_GET["language"])){
        $language = $_GET["language"]; 
        if ($language == "en") {
            header("Location: searchpublication.php");
        } else {
            header("Location: searchpublicationGR.php");
        } 
    }
    else{

    }
?>

<html>

<head>
    <title>MySQL Table Viewer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/mystyle.css">
    <!-- Material Design for Bootstrap fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
        <script src="layouts/loggedtopbarGR.js"></script>
        <script src="layouts/topbargr.js"></script>
</head>
<body>
<div class="outer">
<?php
    session_start();
    
	if(!isset($_SESSION['id'],$_SESSION['role']))
	{
        ?>
        <topbar-component-gr></topbar-component-gr>
        <?php
    }
    else{
        ?>
        <loggedtopbar-component-gr></loggedtopbar-component-gr>
        <?php
    }	
    ?>
  
       
        <div class="row">
            <div class=" "></div>
            <div class="column column-40">
                <div class="center-div">
                    <h3>Φόρμα Αναζήτησης</h3>
                    <form action="showsearchedpublicationGR.php" method="post"> 
                        Αναζήτηση: <input type="text" name="term" /><br /> <br /> 
                        <input type="submit" value="Submit" /> 
                    </form> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>
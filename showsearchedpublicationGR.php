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
        <script src="layouts/loggedtopbar.js"></script>
        <script src="layouts/topbar.js"></script>
</head>

<body>
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
    
$db_host = 'localhost';
$db_user = 'root';
$db_pwd = 'samael';

$database = 'psdsv';
$table = 'article';

$link = mysqli_connect("localhost", "root", "samael", "psdsv");
$searchfield = mysqli_real_escape_string($link,$_REQUEST['term']); 
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// sending query
$result = mysqli_query($link, "SELECT * FROM {$table} WHERE bibtexkey LIKE '%{$searchfield}%' OR author LIKE '%{$searchfield}%' OR title LIKE '%{$searchfield}%'");

if (!$result) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result);

echo "<h1>Publications: {$table}</h1>";
echo "<table class=\"table\"><thead class=\"thead-dark\"><tr>";
// printing table headers
for ($i = 0; $i < $fields_num; $i++) {
    $field = mysqli_fetch_field($result);
    echo "<th scope=\"col\" class=\"{$field->name}\">{$field->name}</td>";
}
echo "</tr></thead><tbody>";
// printing table rows

while ($row = mysqli_fetch_row($result)) {
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach ($row as $cell) {
        echo "<td>$cell</td>";
    }

    echo "</tr>\n";
}
echo "</tbody></table>";
mysqli_free_result($result);
?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $('body').bootstrapMaterialDesign();
    });
    </script>
</body>

</html>
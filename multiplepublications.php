<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/milligram.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/mystyle.css">
    <link rel="stylesheet"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css"
        type="text/css" />

    <script src="layouts/loggedtopbar.js"></script>
</head>

<body>

    <loggedtopbar-component></loggedtopbar-component>


    <div class="row">
        <div class="column column-40">
            <div class="center-div">
                <h2>Insert New Journal</h2>
                <form action="uploadpublications.php" method="POST" name="formupload" enctype = "multipart/form-data">
                    <button id="filechooser" type="button" class="button button-outline" onclick="getFile()">Upload a File</button>    
                    <div style='height: 0px;width:0px; overflow:hidden;'>
                        <input name="upfile" id="upfile" type="file" onchange="sub(this)" />
                    </div>
                    <h3>OR</h3>
                    <label for="biburl">Paste File Url</label>
                    <input type="text" id="biburl" name="biburl" /><br><br>
                    <input type="submit" value='submit' />
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
    function getFile() {
        document.getElementById("upfile").click();
    }

    function sub(obj) {
        var file = obj.value;
        var fileName = file.split("\\");
        document.getElementById("filechooser").innerHTML = fileName[fileName.length - 1];
        console.log(fileName[fileName.length - 1]);
    }
    </script>

</body>

</html>
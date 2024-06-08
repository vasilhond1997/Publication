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

                <form style="width:400px;" action="insertpub.php" method="post" onSubmit="return checkPassword(this)">
                    <fieldset>
                        <div class="outer">
                            <label for="journal_title" id="label_title">Choose Publication Type</label>
                            <select id="publication_type">
                                <option value="article">article</option>
                                <option value="inproceedings">inproceedings</option>
                                <option value="book">book</option>
                                <option value="inbook">inbook</option>
                            </select>
                            <div id="authors">
                                <label for="author">Author</label>
                                <input type="text" placeholder="" name="author" id="author" value="" class="auto" required>
                            </div>
                            <input type="button" value="Add new author.." id="add" />
                            <label for="title">Article Title</label>
                            <input type="text" placeholder="Empirical assessment of expertise." name="title" id="title" required>
                            <label for="year">Year of Publication</label>
                            <input type="text" placeholder="2020" name="year" id="year" required>
                            <label for="note">Note</label>
                            <input type="text" placeholder="" name="note" id="note">
                            <label for="month">Month</label>
                            <input type="text" placeholder="" name="month" id="month">
                            <label for="URL">URL</label>
                            <input type="text" placeholder="" name="URL" id="URL">
                            <label for="key">key</label>
                            <input type="text" placeholder="" name="key" id="key">
                            <!-- Add Article Form -->
                            <div class="publication_form" id="article">
                                <label for="journal_title">Journal Title</label>
                                <input type="text" placeholder="Human Factors" name="journal_title" id="journal_title" required>
                                <label for="volume">Volume</label>
                                <input type="text" placeholder="2" name="volume" id="volume">
                                <label for="number">Number</label>
                                <input type="text" placeholder="12" name="number" id="number">
                                <label for="pages">Pages</label>
                                <input type="text" placeholder="40-52" name="pages" id="pages">
                                <label for="doi">Document Object Identifier</label>
                                <input type="text" placeholder="0.1000/182" name="doi" id="doi">
                            </div>
                            <!-- Add Inproceedings Form -->
                            <div class="publication_form" id="inproceedings">
                                <label for="booktitle">BookTitle</label>
                                <input type="text" placeholder="Human Factors" name="booktitle" id="booktitle" required>
                                <label for="editor">Editors</label>
                                <input type="text" placeholder="Harisson J, Marley S." name="editor" id="editor">
                                <label for="volume">Volume</label>
                                <input type="text" placeholder="12" name="volume" id="volume">
                                <label for="number">Number</label>
                                <input type="text" placeholder="40-52" name="number" id="number">
                                <label for="series">Series</label>
                                <input type="text" placeholder="3" name="series" id="series">
                                <label for="pages">Pages</label>
                                <input type="text" placeholder="40-52" name="pages" id="pages">
                                <label for="address">Address</label>
                                <input type="text" placeholder="London Street 3" name="address" id="address">
                                <label for="organization">Organization</label>
                                <input type="text" placeholder="" name="organization" id="organization">
                                <label for="publisher">Publisher</label>
                                <input type="text" placeholder="" name="publisher" id="publisher">
                                <label for="doi">Document Object Identifier</label>
                                <input type="text" placeholder="" name="doi" id="doi">
                            </div>
                            
                            <!-- Add Book Form -->
                            <div class="publication_form" id="book">
                                <label for="publisher">Publisher</label>
                                <input type="text" placeholder="" name="publisher" id="publisher" required>
                                <label for="volume">Volume</label>
                                <input type="text" placeholder="12" name="volume" id="volume">
                                <label for="number">Number</label>
                                <input type="text" placeholder="40-52" name="number" id="number">
                                <label for="series">Series</label>
                                <input type="text" placeholder="3" name="series" id="series">
                                <label for="address">Address</label>
                                <input type="text" placeholder="London Street 3" name="address" id="address">
                                <label for="edition">Edition</label>
                                <input type="text" placeholder="40-52" name="edition" id="edition">
                                <label for="month">Month</label>
                                <input type="text" placeholder="40-52" name="month" id="month">
                                <label for="ISBN">ISBN</label>
                                <input type="text" placeholder="2" name="ISBN" id="ISBN">
                                <label for="ISSN">ISSN</label>
                                <input type="text" placeholder="2" name="ISSN" id="ISSN">
                            </div>
                             <!-- Add Inbook Form -->
                             <div class="publication_form" id="inbook">
                                <label for="publisher">Publisher</label>
                                <input type="text" placeholder="" name="publisher" id="publisher" required>
                                <label for="chapter">Chapter</label>
                                <input type="text" placeholder="2" name="chapter" id="chapter" required>
                                <label for="pages">Pages</label>
                                <input type="text" placeholder="40-52" name="pages" id="pages" required>
                                <label for="volume">Volume</label>
                                <input type="text" placeholder="12" name="volume" id="volume">
                                <label for="number">Number</label>
                                <input type="text" placeholder="40-52" name="number" id="number">
                                <label for="series">Series</label>
                                <input type="text" placeholder="3" name="series" id="series">
                                <label for="type">Type</label>
                                <input type="text" placeholder="2" name="type" id="type">
                                <label for="address">Address</label>
                                <input type="text" placeholder="London Street 3" name="address" id="address">
                                <label for="edition">Edition</label>
                                <input type="text" placeholder="40-52" name="edition" id="edition">
                                <label for="ISBN">ISBN</label>
                                <input type="text" placeholder="2" name="ISBN" id="ISBN">
                                <label for="ISSN">ISSN</label>
                                <input type="text" placeholder="2" name="ISSN" id="ISSN">
                            </div>
                              <!-- Add Incollection Form -->
                              <div class="publication_form" id="inbook">
                                <label for="editor">Editor</label>
                                <input type="text" placeholder="" name="editor" id="editor">
                                <label for="boobktitle">Booktitle</label>
                                <input type="text" placeholder="" name="boobktitle" id="boobktitle">
                                <label for="pages">Pages</label>
                                <input type="text" placeholder="" name="pages" id="pages">
                                <label for="volume">Volume</label>
                                <input type="text" placeholder="" name="volume" id="volume">
                                <label for="series">Series</label>
                                <input type="text" placeholder="" name="series" id="series">
                                <label for="address">Publisher</label>
                                <input type="text" placeholder="" name="publisher" id="publisher">
                                <label for="edition">DOI</label>
                                <input type="text" placeholder="" name="doi" id="doi">
                                <label for="ISBN">Timestamp</label>
                                <input type="text" placeholder="" name="timestamp" id="timestamp">
                                <label for="ISSN">Bibsource</label>
                                <input type="text" placeholder="" name="bibsource" id="bibsource">
                            </div>
                            <input class="button-primary" type="submit" value="Send">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
    function checkPassword(form) {
        password1 = form.passwordField.value;
        password2 = form.passwordField2.value;

        // If password not entered
        if (password1 == '')
            alert("Please enter Password");

        // If confirm password not entered
        else if (password2 == '')
            alert("Please enter confirm password");

        // If Not same return False.
        else if (password1 != password2) {
            alert("\nPassword did not match: Please try again...")
            return false;
        }

        // If same return True.
        else {
            alert("Password Match: Welcome to GeeksforGeeks!")
            return true;
        }
    }

    $(function() {
        $('.publication_form').hide();
        $('#publication_type').change(function() {
            var v = this.value;
            $('.publication_form').hide();
            $('#' + v).show();
        });
    });

    $(function() {
        //autocomplete
        $(".auto").autocomplete({
            source: "suggestedauthors.php",
            minLength: 1
        });

    });

    var id = 2;

    window.addEventListener("load", function() {
        document.getElementById("add").addEventListener("click", function() {

            var div = document.getElementById("authors");
            var lab = document.createElement("label");
            lab.innerHTML = "Author" + id;
            lab.setAttribute("for", "author" + id);

            var inp = document.createElement("input");
            inp.setAttribute("type", "text");
            inp.setAttribute("name", "author" + id);
            inp.setAttribute("name", "author" + id);
            inp.setAttribute("class", "auto");

            id++;


            // add the file and text to the div
            div.appendChild(lab);
            div.appendChild(inp);

        });
    });
    </script>

</body>

</html>
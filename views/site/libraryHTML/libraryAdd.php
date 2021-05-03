<?php

/*
 * Upload XML file form.
 */
echo "
    <section class='section section__main'>
        <div class='shell'>
            <div class='section--head'>
                <h3> Insert XML File</h3>
            </div>
        
            <div class='section--body'>
                <div class='form__insert'>
                     <form action='" . APPLICATION_PATH . "index.php?controller=library&action=createBook' method='post' enctype='multipart/form-data'>
                            <input class='form__insert--input' type='file' accept='text/xml'  name='file_to_upload'><br>
                            
                            <button class='button' name='create' value='true'>Create</button>
                    </form>
                </div>  
        </div>
";

/*
 * Display content of uploaded file.
 */

if(isset($data->book)) {
    echo "<h3> XML file content </h3>";

    echo "<table class='table--search'>
            <tr>
                <th>Author</th>
                <th>Book</th>
            </tr>
    ";

    foreach ($data->book as $book) {
        echo "<tr>";
            echo "<td>" . $book->author . "</td>";
            echo "<td>" . $book->name . "</td>";
        echo "</tr>";
    }
}
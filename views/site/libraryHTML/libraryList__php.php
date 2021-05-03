<?php

    /*
    * Search authors with PHP.
    */

    /*
    * Search form.
    */
    echo "
        <section class='section section__main'>
            <div class='shell'>
                 <div class='section--head'>
                    <h3> Search Books By Author</h3>
                </div>
        
                <div class='section--body'>
                        <div class='search'>
                            <form action=' " . APPLICATION_PATH . "index.php?controller=library&action=listAll__php' method='post'>
                                <div class='autocomplete'>
                                    <input class='search--input' name='topic'  type='text' id='searchInput'>
                                </div>
                    
                                <button class='button' type='submit' name='search' value='true'>Search</button>
                            </form>
                        </div>
            </div>
    ";

    /*
    * Display books in table.
    */
    if (!empty($data) && is_array($data)) {
        echo "
            <table class='table--search' id='books'>
                <tr>
                    <th>Author</th>
                    
                    <th>Book</th>
                </tr>
        ";

        foreach ($data as $book) {
            echo "<tr>";
                echo "<td>" . $book['full_name'] . "</td>";
                echo "<td>" . $book['title'] . "</td>";
            echo "</tr>";
        }

    }
?>
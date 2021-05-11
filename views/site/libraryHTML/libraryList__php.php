<?php

$allBooks = [];
$searchedBooks = [];

    if (is_array($data) && !empty($data)) {
        if (count($data) > 2) {
            $allBooks = $data;
            $searchedBooks = $data;
        } else {
            $allBooks = $data[0];
            $searchedBooks = $data[1];
        }
    }
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
                            <form autocomplete='off' action=' " . APPLICATION_PATH . "index.php?controller=library&action=listAll__php' method='post'>
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
    if (!empty($allBooks) && is_array($allBooks)) {
        echo "
            <table class='table--search' id='books'>
                <tr>
                    <th>Author</th>
                    
                    <th>Book</th>
                </tr>
        ";

        foreach ($allBooks as $book) {
            echo "<tr>";
                echo "<td>" . $book['full_name'] . "</td>";
                echo "<td>" . $book['title'] . "</td>";
            echo "</tr>";
        }

    }

    /*
    * Autocomplete.
    */
    if (!empty($searchedBooks) && is_array($searchedBooks)) {
        echo "
    <script src='views/js/Autocomplete.js'>
    </script>
    
    <script>
        const books = " . json_encode($searchedBooks) . "; 
       
        const searchInput = document.getElementById('searchInput'); 
           
        autocomplete(document.getElementById('searchInput'), books);
    </script>
        ";
    }
?>
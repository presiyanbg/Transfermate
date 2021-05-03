<?php
    /*
    * Search authors with JavaScript.
    */

    echo "
        <section class='section section__main'>
            <div class='shell'>
                 <div class='section--head'>
                    <h3> Search Books By Author</h3>
                </div>
    ";

    /*
    * Search input.
    */

    echo "
        <div class='section--body'>
            <div class='search'>
                <input class='search--input' type='text' id='searchBooks'>
            </div>
            ";

    /*
    * Display books in table.
    */

    echo "
        <table class='table--search' id='table__headers'>
            <tr>
                <th>Author</th>
                <th>Book</th>
            </tr>
        </table>";

    echo "
            <table class='table--search' id='table__data'></table>
        </div>
    </div>";

    /*
    * JS script.
    */

    echo "<script> 
    const books = " . json_encode($data) . ";
    const booksTable = document.getElementById('table__data');
    const searchBookInput = document.querySelector('#searchBooks');
    const searchBookInputValue = document.getElementById('searchBooks');
    
    function displayBooks() {
        const author = searchBookInputValue.value;
        
        booksTable.innerHTML = '';
        
        if (searchBookInputValue.value === '') {
            for (let book of books) {
                let row = booksTable.insertRow();
                
                let columnAuthor = row.insertCell(0)
                columnAuthor.innerHTML = book.full_name;
                
                let columnBTitle = row.insertCell(1);
                columnBTitle.innerHTML = book.title;
            }
        } else {
             for (let book of books) {
                 if (((book.full_name).toLocaleLowerCase()).includes(author.toLocaleLowerCase())) {
                    let row = booksTable.insertRow();
                
                    let columnAuthor = row.insertCell(0)
                    columnAuthor.innerHTML = book.full_name;
                    
                    let columnBTitle = row.insertCell(1);
                    columnBTitle.innerHTML = book.title;
                 }
                
            }
        }
    }
    
    function clearTable() {
        let rowsCount =  booksTable.rows.length; 
                
        for (let i = 1; i < rowsCount; i++) {
            booksTable.deleteRow(i);
        }
    }
   
    displayBooks();
    
    searchBookInput.addEventListener('input', (e) => {
        displayBooks();      
    });
    </script>
    ";

?>
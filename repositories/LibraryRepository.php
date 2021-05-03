<?php


class LibraryRepository extends Db
{
    /*************************************************************
     *      Public Functions
     *************************************************************/

    /*
     *  - Create Book
     * Checks Database for book and author.
     * Inserts into Database.
     */
    public function createBooks($data) {
        foreach ($data as $book) {
            if (!$this->checkIfAuthorExists($book->author)) {
                $this->addAuthor($book->author);
            }

            if (!$this->checkIfBookExists($book)) {
                $author_id = $this->getAuthorId($book->author);

                $this->addBook($author_id, $book->name);
            }
        }
    }

    /*
     *  - Get All
     * Selects all books from Database.
     */
    public function getAll() {
        $stmtGetAll = pg_query($this->conn,  '
            SELECT title, full_name 
            FROM books 
            JOIN authors ON authors.author_id = books.author_id  ');

        return pg_fetch_all($stmtGetAll);
    }

    /*
     *  - Search By Author Name
     * Search for author/s in Database.
     */
    public function searchByAuthorName($author) {
        $stmtGetAll = '
            SELECT title, full_name 
            FROM books 
            JOIN authors ON authors.author_id = books.author_id 
            WHERE 
                LOWER(full_name) LIKE LOWER($1)
        ';

        $value = array('%'.$author.'%');

        $result = pg_query_params($this->conn, $stmtGetAll, $value);

        return pg_fetch_all($result);
    }

    /*************************************************************
     *      Private functions used in fun. createBook
     *************************************************************/

    /*
     *  Checks if book exists in Database.
     */
    private function checkIfBookExists($book) {
        $queryCheckBook = "
            SELECT * FROM books 
            WHERE 
                title = $1
                AND 
                (SELECT author_id FROM authors WHERE full_name = $2) = author_id
        ";

        $result = pg_query_params($this->conn, $queryCheckBook, array($book->name, $book->author));

        if (!empty(pg_fetch_all($result))) {
            return true;
        } else {
            echo false;
        }
    }

    /*
     * Checks if author exists in Database
     */
    private function checkIfAuthorExists($author) {
        $sqlCheckAuthor = "
            SELECT * FROM authors 
            WHERE 
                full_name = $1
        ";

        $result = pg_query_params($this->conn, $sqlCheckAuthor, array($author));

        if (empty(pg_fetch_all($result))) {
            return false;
        } else {
            return true;
        }
    }

    /*
     * Adds book to Database.
     */
    private function addBook($author_id, $book)
    {
        $sqlAddBook = "
            INSERT INTO books 
                (author_id, title) 
            VALUES ( $1, $2); 
        ";

        $result = pg_query_params($this->conn, $sqlAddBook, array(intval($author_id[0]), $book));
    }

    /*
     * Adds author to Database.
     */
    private function addAuthor($author) {
        $sqlAddAuthor = "
            INSERT INTO authors 
                (full_name) 
                VALUES ($1); 
        ";

        $result = pg_query_params($this->conn, $sqlAddAuthor, array($author));
    }

    /*
     * Gets (Select) authors ID from Database.
     */
    private function getAuthorId($author) {
        $sqlCheckAuthor = "
            SELECT author_id FROM authors 
            WHERE 
                full_name = $1
        ";

        $result = pg_query_params($this->conn, $sqlCheckAuthor, array($author));

        return pg_fetch_row($result);
    }


}
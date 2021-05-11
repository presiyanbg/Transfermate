<?php

class UploadManager
{
    /*************************************************************
     *  Container for books
    *************************************************************/
    private $allBooks = [];

    /*************************************************************
     *  Get All Books
    *************************************************************/
    public function getAllBooks(){
        $target_dir = XML_FILES_MAIN_DIRECTORY;

        $this->openAllDirectories($target_dir);

        return $this->allBooks;
    }

    /*************************************************************
     *  Opens all directories.
    *************************************************************/
    private function openAllDirectories($target_dir){
        $allDirectories = scandir($target_dir);

        foreach ($allDirectories as $dir) {
            if ($dir != "." && $dir != "..") {
                $dirPath = $target_dir . "/" . $dir;
                if (is_dir($dirPath)) {
                    $this->openAllDirectories($dirPath);
                } else {
                    $this->openFile($dirPath);
                }
            }
        }
    }

    /*************************************************************
     *  Opens file and reads it if is XML.
    *************************************************************/
    private function openFile($file){
        $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if ($file_type == "xml") {
            $xml = array(simplexml_load_file($file));

            if ($xml) {
                $booksFromFile = $xml[0];

                //Adds only new books to booksArray
                foreach ($booksFromFile as $newBook) {
                    $bookExists = false;

                    foreach ($this->allBooks as $addedBook) {
                        if (strcmp($addedBook->name,$newBook->name) == 0 && strcmp($addedBook->author,$newBook->author) == 0) {
                            $bookExists = true;
                            break;
                        }
                    }

                    if ($bookExists === false) {
                        array_push($this->allBooks, $newBook);
                    }
                }
            }
        }
    }
}
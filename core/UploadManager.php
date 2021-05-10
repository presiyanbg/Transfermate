<?php

class UploadManager
{
    /*************************************************************
     *  Upload XML file
     *************************************************************/
    public function getAllBooks(){
        $target_dir = XML_FILES_MAIN_DIRECTORY;

        $allDirectories = $this->getAllDirectories($target_dir);;

        $allBooks = $this->getAllXMLFiles($allDirectories);

        return $allBooks;
    }

    /*************************************************************
     *  Get all directories.
     *************************************************************/
    private function getAllDirectories($target_dir){
        $allDirectories = [];

        if ($handle = opendir($target_dir)) {
            while (false !== ($entry = readdir($handle))) {
                if (is_dir($target_dir.$entry)) {
                    array_push($allDirectories, $target_dir.$entry);
                }
            }
        }

        return $allDirectories;
    }

    /*************************************************************
     *  Get all XML files.
     *************************************************************/
    private function getAllXMLFiles($allDirectories){
        $allBooks= [];

        foreach ($allDirectories as $dir) {
            if ($handle = opendir($dir)) {
                while (false !== ($entry = readdir($handle))) {
                    $file_path = $dir."/".$entry;

                    /*
                    * Get file type
                    */
                    $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));


                    /*
                     * Check file extension
                     */
                    if ($file_type == "xml") {
                        $xml = array(simplexml_load_file($file_path));

                        if ($xml) {
                            $booksFromFile = $xml[0];


                            //Adds new books to booksArray
                            foreach ($booksFromFile as $newBook) {
                                $bookExists = false;

                                foreach ($allBooks as $addedBook) {
                                    if (strcmp($addedBook->name,$newBook->name) == 0 && strcmp($addedBook->author,$newBook->author) == 0) {
                                        $bookExists = true;
                                        break;
                                    }
                                }

                                if ($bookExists === false) {
                                    array_push($allBooks, $newBook);
                                }
                            }
                        }
                    }

                }
            }
        }

        return $allBooks;
    }
}
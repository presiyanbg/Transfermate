<?php

class UploadManager
{
    /*************************************************************
     *  Upload XML file
     *************************************************************/
    public function uploadXML() {
        $target_dir = "views/XML/";
        $file_name = ($_FILES["file_to_upload"]["name"]);
        $final_path_to_file = $target_dir . $file_name;
        $uploadOk = true;

        /*
        * Check encoding
        */
        $encoding = mb_detect_encoding($file_name);
        if($encoding != "UTF-8"){
            //specify from which encoding to convert to utf-8
            $file_name = mb_convert_encoding($file_name, "UTF-8", $encoding);
        }

        /*
         * Check if File is XML
         */
        $check = $xml = XMLReader::open($_FILES["file_to_upload"]["tmp_name"]);
        if (!$check) {
            $uploadOk = false;
            echo "File is not an XML";
        }

        /*
        * Check if file already exists in the folder
        */
        if (file_exists($final_path_to_file) && $check) {
            $newFile = array(simplexml_load_file($_FILES["file_to_upload"]["tmp_name"]));
            $oldFile = array(simplexml_load_file($final_path_to_file));

            //Stores all books -> new + old.
            $booksArray = [];

            //Adds old books to booksArray
            foreach ($oldFile[0] as $oldBook) {
                array_push($booksArray, $oldBook);
            }

            //Adds new books to booksArray
            foreach ($newFile[0] as $newBook) {
                $bookExists = false;

                foreach ($booksArray as $oldBook) {
                    if (strcmp($oldBook->name,$newBook->name) == 0 && strcmp($oldBook->author,$newBook->author) == 0) {
                        $bookExists = true;
                        break;
                    }
                }

                if ($bookExists === false) {
                    array_push($booksArray, $newBook);
                }
            }

            //Creates new XML file
            $xml = new SimpleXMLElement('<books/>');

            //Adds all books to the new XML file
            foreach ($booksArray as $book) {
                $xmlObject = $xml->addChild('book');
                $xmlObject->addChild('author', $book->author);
                $xmlObject->addChild('name', $book->name);

            }

            //Saves the new XML file
            $xml->saveXML($final_path_to_file);

            //Returns the NEW file
            return $file_name;
        } else {
            /*
            * Check if file is under the allowed size
            */
            if ($_FILES["file_to_upload"]["size"] > 10000000) {
                $uploadOk = false;
                echo "File size is above the limitation";
            }

            /*
            * Get file type
            */
            $file_type = strtolower(pathinfo($final_path_to_file, PATHINFO_EXTENSION));

            /*
             * Check file extension
             */
            if ($file_type !== "xml") {
                $uploadOk = false;
                echo "File type is not supported";
            }

            /*
            * Upload file
            */
            if (!$uploadOk) {
                echo "XML will not be uploaded";
                return false;
            } else {
                if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $final_path_to_file)) {
                    //Returns the NEW file
                    return $file_name;
                } else {
                    return false;
                }
            }
        }
    }
}
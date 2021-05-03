<?php


class LibraryController extends BaseController
{
    /*************************************************************
     *      Private Variables
     *************************************************************/

    /*
     * Connection to Database.
     */
    private $libraryRepository;

    /*
     * Connection to upload manager.
     */
    private $uploadManager;

    /*************************************************************
     *      Constructor.
     *************************************************************/
    function __construct() {
        $this->libraryRepository= new LibraryRepository();
        $this->uploadManager = new UploadManager();
    }

    /*************************************************************
     *      Insert XML file and insert content to Database.
     *************************************************************/
    public function createBook() {
        if (!empty($_POST) && !empty($_POST["create"])) {
            if (empty($_FILES["file_to_upload"]["error"])) {
                $file_name = $this->uploadManager->uploadXML();

                if (!$file_name) {
                    return false;
                } else {
                    $books = simplexml_load_file("views/XML/" . $file_name);

                    $this->libraryRepository->createBooks($books);

                    return $books;
                }
            }
        } else {
            return true;
        }
    }

    /*************************************************************
     *      Get all books from Database.
     *************************************************************/
    /*
     * Gets all books and search with PHP
     */
    public function listAll__php() {
        if (!empty($_POST) && !empty($_POST["search"]) && !empty($_POST["topic"])) {
            $searchResults = $this->libraryRepository->searchByAuthorName($_POST["topic"]);

            if (sizeof($searchResults) > 0) {
                return $searchResults;
            } else {
                return true;
            }
        } else {
            return $this->libraryRepository->getAll();
        }
    }

    /*
     * Gets all books and returns them to JS
     */
    public function listAll__js() {
        return $this->libraryRepository->getAll();
    }

}
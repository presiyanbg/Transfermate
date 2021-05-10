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

        $this->updateBooks();
    }

    /*************************************************************
     *      Update Books Database.
     *************************************************************/
    public function updateBooks() {
        $allBooks = $this->uploadManager->getAllBooks();

        if ($allBooks) {
            $this->libraryRepository->createBooks($allBooks);
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
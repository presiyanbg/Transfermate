<?php
require_once "navigation.php";

/*
 * Check Controller and open correct page
 */
if (!empty($data)) {
    switch ($_GET["action"]) {
        case "listAll__php":
            require_once "libraryHTML/libraryList__php.php";
            break;
        case "listAll__js":
            require_once "libraryHTML/libraryList__js.php";
            break;
        case "createBook":
            require_once "libraryHTML/libraryAdd.php";
            break;
        default:
            require_once "libraryHTML/libraryList__php.php";
            break;
    }
}

require_once "footer.php";
?>


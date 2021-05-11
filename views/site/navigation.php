<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transfermate library</title>

    <link rel="stylesheet" type="text/css" href="<?php echo APPLICATION_PATH?>views/css/main.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo APPLICATION_PATH?>views/css/animation.css?v=<?php echo time(); ?>">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <div class="header clear--fix">
        <div class="header__background">
            <img src="<?php echo APPLICATION_PATH?>views/css/img/background.jpg">
        </div>

        <div class="header__logo">
            <a href="<?php echo APPLICATION_PATH?>index.php">Transfermate Library</a>
        </div>

        <nav class="header__links">
            <ul>
                <li>
                    <a href="<?php echo APPLICATION_PATH?>index.php?controller=library&action=listAll__php">Search By PHP</a>
                </li>

                <li>
                    <a href="<?php echo APPLICATION_PATH?>index.php?controller=library&action=listAll__js">Search By JS</a>
                </li>
            </ul>
        </nav>
    </div>



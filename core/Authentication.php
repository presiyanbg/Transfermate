<?php

class Authentication
{
    function __construct() {
    }

    public static function login() {
        if (!empty($_GET["login"]) && $_GET["login"] === "true") {
            $_SESSION = [];
            session_destroy();
            return true;
        } else {
            return false;
        }
    }

    public static function register() {
        if (!empty($_GET["register"]) && $_GET["register"] === "true") {
            return true;
        } else {
            return false;
        }
    }

    public static function authenticate() {
        if (!empty($_POST)) {
            if (!empty($_POST["username"]) && !empty($_POST["password"])) {
                $userModel = new UserModel();
                $password = hash("sha256", $_POST["password"]);
                $user = $userModel->viewByUsernameAndPassword($_POST["username"], $password);
                if (!empty($user)) {
                    $_SESSION["uid"] = $user->user_id;
                    $_SESSION["uprivilege"] = $user->privilege_level;
                    $_SESSION["full_name"] = $user->f_name . " " . $user->l_name;
                    return true;
                }
            }

            return false;
        } else {
            return false;
        }
    }

    public static function signUp() {
        if (!empty($_POST) && !empty($_POST["sign_up"])) {
            $userModel = new UserModel();
            $_POST["password"] = hash("sha256", $_POST["password"]);
            $userModel->create($_POST);
            header("Location: index.php?login=true");
        } else {
            return false;
        }
    }
}
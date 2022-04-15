<?php

require_once("dbconnect.php");
require_once("MyError.php");
require_once("Controller.php");

session_start();

$controller = new Controller($connection);
$form_username = htmlentities(trim($_POST['username']));
// $form_username = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_REGEXP, [
//    "options" => [
//        "regexp" => '#^[A-Za-z][A-Za-z0-9_]{4,29}$^#'
//    ]
// ]);

if (is_string($form_username)) {

    $form_password = htmlentities(trim($_POST['password']));
    //    $form_password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, [
    //        "options" => [
    //            "regexp" => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$^'
    //        ]
    //    ]);

    if (is_string($form_password)) {
        $user = $controller->getUser($form_username);
        if (is_array($user)) {
            $_SESSION['error']->setError(-2, "Identifiant non disponible");
            header("Location:sign-in.php?error");
        } else {
            $password2 = filter_input(INPUT_POST, 'pwdverif', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
            if ($password2 === $form_password) {
                $status = $controller->addUser(strtolower($form_username), password_hash($form_password, PASSWORD_ARGON2I));
                if ($status) {
                    header("Location:index.php");
                } else {
                    $_SESSION['error']->setError(-3, "Erreur inconnue");
                    header("Location:sign-in.php?error");
                }
            } else {
                $_SESSION['error']->setError(-4, "Mdp pas identiques");
                header("Location:sign-in.php?error");
            }
        }
    }
}

<?php

require_once("dbconnect.php");
require_once("MyError.php");
require_once("Controller.php");

session_start();
//recuperer le contenu de nos variables

//pour utiliser le controller je suis obligé de l'instancié avec un argument
$controller = new Controller($connection);
$form_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

// recupère les champs du formulaire

$user = $controller->getUser($form_username);
//dd($user); vardump + die;
if (is_array($user)) { //function verifypassword marche pas

    $form_password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);
    //$form_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    // if ($controller->verify_password($form_password)) {

    if (password_verify($form_password, $user['password'])) {
        if (hash_equals($_SESSION['token'], $token)) {
            // verifie que 2 hash sont égal
            $_SESSION['user'] = $user;
            header("Location:index.php");
        }
    } else {
        $_SESSION['error']->setError(-1, "Identification incorrecte !");
        header("Location:index.php?error");
    }
} else {
    $_SESSION['error']->setError(-10, "Identification incorrecte !");
    header("Location:index.php?error");
}

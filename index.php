<?php
require_once("MyError.php");
session_start();

$_SESSION['token'] = bin2hex(random_bytes(24));
// token = jeton unique à la session


if (!isset($_SESSION['error']))
    $_SESSION['error'] = new MyError;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Secure</title>
</head>

<body>
    <div class="wrapper">
        <section>
            <?php
            if (isset($_GET['error'])) {
                echo "<strong>" . $_SESSION['error'] . "</strong>";
            }

            if (!isset($_SESSION['user'])) {
                echo "<h1>Connectez-vous ! ou <a href='sign-in.php' class='lien'>inscrivez-vous içi</a></h1>";
            } else {
                echo "Bienvenue" . ucwords($_SESSION['user']['username']) . "!";
                echo "<a href='logout.php'>Deconnexion</a>";
            }
            ?>

            <!-- CREATION D'UN FORMULAIRE SIMPLE EN HTML POUR LE TRAVAILLER -->

            <form action="login.php" method="post">
                <!-- L'attribut ACTION décrit comment le formulaire HTML doit être traité (QUEL FICHIER?)
    L'attribut METHOD gère le processus de soumission des données
    POST : Les paramètres sont placés à l'intérieur du corps
    GET : Les paramètres sont placés à l'intérieur de l'URL (Vulnérable, présent en texte clair, peut-être lu par n'importe qui)  -->
                <p><input type="text" name="username" placeholder="Votre login" required></p>
                <p><input type="hidden" value="<?= $_SESSION['token'] ?>" name="token"></p>
                <p><input type="password" name="password" placeholder="Votre mot de passe" required></p>
                <p><input type="submit" value="Connexion" required></p>

            </form>
        </section>
    </div>
</body>



</html>
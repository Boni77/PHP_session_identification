<?php
require_once('MyError.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign In</title>
</head>

<body>
    <div class="wrapper">
        <section>
            <?php
            // c'est içi qu'on affiche l'erreur
            if (isset($_GET['error'])) {
                echo "<strong>" . $_SESSION['error'] . "</strong>";
            }
            ?>

            <form action="add_user.php" method="post">
                <h1>Inscrivez-vous ! ou <a href='index.php' class='lien'>connectez-vous içi</a></h1>
                <p><input type="text" placeholder="Votre login" name="username" required></p>
                <p><input type="password" placeholder="Mot de passe" name="password" required></p>
                <p><input type="password" placeholder="Confirmation" name="pwdverif" required></p>
                <p>
                <h6>En cliquant sur Enregistrer, vous acceptez <a href="cgu.php">les conditions général d'utilisation</a></h6>
                </p>
                <p><input type="submit" value="Enregistrer"></p>
            </form>
        </section>
    </div>
</body>

</html>
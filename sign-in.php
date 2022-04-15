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
    <title>Sign In</title>
</head>

<body>
    <?php
    // c'est içi qu'on affiche l'erreur
    if (isset($_GET['error'])) {
        echo "<strong>" . $_SESSION['error'] . "</strong>";
    }
    ?>

    <form action="add_user.php" method="post">
        <input type="text" placeholder="Votre login" name="username" required>
        <input type="password" placeholder="Mdp" name="password" required>
        <input type="password" placeholder="Confirme mdp" name="pwdverif" required>
        <input type="submit" value="inscription">
    </form>
</body>

</html>
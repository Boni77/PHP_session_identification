<?php

session_start();
unset($_SESSION['user']); //on supprime les variables de la session
unset($_SESSION['error']);
header("Location:index.php");

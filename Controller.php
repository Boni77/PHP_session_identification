<?php

//un controller à pour but de traiter une requete
class Controller
{
    private $_connection;
    private $_user;

    public function __construct($connection)
    {
        $this->_connection = $connection;
    }

    public function getUser($form_username)
    {
        try {
            // Il faut faire la requête :
            $sql = "SELECT username, password FROM user WHERE username = LOWER(:uname) ;";
            // requête preparé sans exécution envoyé au serveur
            $statement = $this->_connection->prepare($sql);
            // injection de parametre
            // bind = attacher les parametres
            $statement->bindParam("uname", $form_username);
            // Executer la requete
            $statement->execute();

            // on recupère l'object utilisateur de la bdd
            $this->_user = $statement->fetch();
            return $this->_user;
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    public function verify_password($upwd)
    // quand on comprare des mots de passes on comprare des chaine de caractère hashé

    {
        return password_verify($upwd, $this->_user['password']);
    }

    public function addUser($uname, $pass)
    //$pass = mdp hashé
    {
        try {
            $sql = "INSERT INTO user (username, password) VALUES (:name, :pwd)";
            $statement = $this->_connection->prepare($sql); //prepare la requete sans l'envoyer
            // injection de parametre
            // bind = attacher les parametres
            $statement->bindParam("name", $uname);
            $statement->bindParam("pwd", $pass);
            // Executer la requete, envoi dan la bdd
            return $statement->execute(); //execute renvoie un boolean vrai si bien passé
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}

if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['souvenir']) && !empty($_COOKIE['souvenir'])) {
        // code
        if (!empty($user)) {
            $_SESSION['user'] = $user;
            header("Location:index.php");
        }
    }
}

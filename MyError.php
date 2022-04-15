<?php

// on crée une class
class MyError
{
    //on crée ces états (propriétés)
    private $_code;
    private $_message;
    private $_time;

    //on crée son comportement (méthodes)

    // première fonction pour la construire, 
    // içi on définit les variables
    function __construct($code = 0, $message = "")
    {
        //on crée un objet erreur
        $this->_code = $code;
        $this->_message = $message;
        $this->_time = new DateTime("NOW", new DateTimeZone("Europe/Paris"));
    }

    function __toString()
    //la fonction toString est l'affichage du message
    {
        return ($this->_code != 0) ? "[" . $this->_time->format('Y-m-d H:i:s') . "] Error" . $this->_code . " : " . $this->_message : "";
    }

    function setError($code = 0, $message = "")
    // on crée une 3e fonction pour REMPLIR l'objet
    {
        $this->_code = $code;
        $this->_message = $message;
        $this->_time = new DateTime("NOW", new DateTimeZone("Europe/Paris"));
    }
}

<?php
require_once 'utilisateur.php';


class authentif {

    public $pdo;

    public function __construct($pdo)
    {
     $this->pdo = $pdo;
    }

    
    public function utilisateur()
    {
     
    }

    public function login ($email, $password)
    {
    $requete = $pdo->prepare("SELECT * FROM utilisateur WHERE email =:email");
    $requete->bindvalue(':email', $emailutilisateur);
    $requete->execute();
    $utilisateur = $requete->fetch();
    if($utilisateur === false){
            echo 'erreur utilisateur non trouvé ';
        }

    if (password_verify($password, $utilisateur->motdepasse)){
            return $utilisateur; 
        }
    }

}


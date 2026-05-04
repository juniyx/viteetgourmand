<?php
session_start();

if(!empty($_POST['email2']) && !empty($_POST['mdp2'])) {
    
    $host = 'localhost';
    $dbname = 'vitegourmand';
    $username = 'root';
    $password = '';
    
    $emailutilisateur = $_POST['email2'];
    $mdputilisateur = $_POST['mdp2'];
    
    
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        
        $requete = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $requete->bindValue(':email', $emailutilisateur);
        $requete->execute();
        $utilisateur = $requete->fetch();
        
        if($utilisateur === false){
            echo 'Erreur : utilisateur non trouvé';
        } elseif (password_verify($mdputilisateur, $utilisateur->motdepasse) && $utilisateur->role ==='utilisateur') {
            $_SESSION['utilisateur_id'] = $utilisateur->id_utilisateur;
            $_SESSION['utilisateur_prenom'] = $utilisateur->prenom;
            $_SESSION['utilisateur_email'] = $utilisateur->email;
            $_SESSION['utilisateur_role'] = $utilisateur->role;
            header('Location: espaceutilisateur.php');
            exit();
        } elseif (password_verify($mdputilisateur, $utilisateur->motdepasse) && $utilisateur->role ==='employe') {
            $_SESSION['utilisateur_id'] = $utilisateur->id_utilisateur;
            $_SESSION['utilisateur_prenom'] = $utilisateur->prenom;
            $_SESSION['utilisateur_email'] = $utilisateur->email;
            $_SESSION['utilisateur_role'] = $utilisateur->role;
            header('Location: espaceemploye.php');
            exit();
        } elseif (password_verify($mdputilisateur, $utilisateur->motdepasse) && $utilisateur->role ==='administrateur') {
            $_SESSION['utilisateur_id'] = $utilisateur->id_utilisateur;
            $_SESSION['utilisateur_prenom'] = $utilisateur->prenom;
            $_SESSION['utilisateur_email'] = $utilisateur->email;
            $_SESSION['utilisateur_role'] = $utilisateur->role;
            header('Location: espaceadministrateur.php');
            exit();
        
        } else {
            echo 'Mot de passe incorrect';
        }
        
    } catch(PDOException $e) {
        error_log($e->getMessage());
        echo 'Erreur de connexion à la base de données';
    }
}


if(!empty($_POST['nom1']) && !empty($_POST['prenom1']) && !empty($_POST['tel1']) && !empty($_POST['email1'] && !empty($_POST['mdp1']) && !empty($_POST['adresse1'])) ) 
{

    $host = 'localhost';
    $dbname = 'vitegourmand';
    $username = 'root';
    $password = '';

    $u_nom = $_POST['nom1'];
    $u_prenom = $_POST['prenom1'];
    $u_tel1 = $_POST['tel1'];
    $u_email1 = $_POST['email1'];
    $u_adresse1 = $_POST['adresse1'];
    $u_role='utilisateur';

    $u_mdp1 = $_POST['mdp1'];
    $hash_mdp = password_hash($u_mdp1, PASSWORD_DEFAULT);


    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        
        $requete = $pdo->prepare("INSERT INTO utilisateur (id_utilisateur, email, motdepasse, nom, prenom, telephone, adresse_postale, role )
        VALUES(?, ?, ?, ?, ?, ?, ?, ?) ");
        $requete->execute(['NULL', $u_email1, $hash_mdp, $u_nom, $u_prenom, $u_tel1, $u_adresse1, $u_role]);

        
    } catch(PDOException $e) {
        error_log($e->getMessage());
        echo 'Erreur de connexion à la base de données';
    }
    


}

?>





<?php
require 'elements/header.php';
?>

<div class="conteneur1">

<h2 class="ttrconnexion">CONNEXION</h2>



<div class="conteneurconnexions">

    <div class="formconnexion1">

        <h5 class="creationcompte">VEUILLEZ COMPLETER LES INFORMATIONS DEMANDEES POUR LA CREATION D'UN COMPTE UTILISATEUR </h5>
        <p class="creationinfo">Si vous ne disposez pas de compte, veuillez completer le formulaire.Par la suite vous disposerez d'un espace utilisateur afin de réaliser vos commandes.</p>
                <form action="" method="POST">
                        
                    <div class="form-group">
                    <label for="nom1">Nom:</label>
                    <input type="text" name="nom1" id="nom1" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="prenom1">Prenom:</label>
                    <input type="text" id="prenom1" name="prenom1" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="tel1">Numero Mobile:</label>
                    <input type="tel1" id="tel1" name="tel1" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="email1">Email:</label>
                    <input type="email" id="email1" name="email1" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="mdp1">Mot de Passe:</label>
                    <input type="password" id="mdp1" name="mdp1" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="adresse1">Adresse postale complete:</label>
                    <input type="text" id="adresse1" name="adresse1" class="form-control" >
                    </div>
                    
                    
                    <button type="submit" class="btn btn-dark" id="creationespace" >ENVOYER LES INFORMATIONS POUR LA CREATION DU COMPTE </button>
                    
                </form>
    </div>


    <div class="formconnexion2">

                <h5 class="seconnecter">SE CONNECTER A SON ESPACE UTILISATEUR</h5>
                <p class="seconinfo"> renseignez vos identifiants pour accéder à votre espace utilisateur.</p>

                <form action="" method="POST">
                        
                    <div class="form-group">
                    <label for="email2">Email:</label>
                    <input type="text" id="email2" name="email2" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="mdp2">Mot de Passe:</label>
                    <input type="password" id="mdp2" name="mdp2" class="form-control" >
                    </div>

                    <button type="submit" class="btn btn-dark" id="connexionutilisateur">CONNEXION</button>
                    
                </form>

    </div>

</div>




<?php                
 require 'elements/footer.php';
?>
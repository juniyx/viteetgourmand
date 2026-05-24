<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];


$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


?>


<?php

if( isset($_POST['nom4']) && isset($_POST['prenom4']) && isset($_POST['tel4']) && isset($_POST['email4']) && isset($_POST['adresse4']) && isset($_POST['role4']))
{
    $nouveau_nom = $_POST['nom4'];
    $nouveau_prenom = $_POST['prenom4'];
    $nouveau_tel = $_POST['tel4'];
    $nouveau_email = $_POST['email4'];
    $nouveau_adresse = $_POST['adresse4'];
    $nouveau_role = $_POST['role4'];


    $nouveau_motdepasse = $_POST['mdp4'];
    $hash_mdp4 = password_hash($nouveau_motdepasse, PASSWORD_DEFAULT);
    
    
    
    
    
        
    $requete22= $pdo->prepare("INSERT INTO utilisateur (email, motdepasse, nom, prenom, telephone, adresse_postale, role)
    VALUES(?, ?, ?, ?, ?, ?, ?) ");
    $finalinsert=$requete22->execute([$nouveau_email, $hash_mdp4, $nouveau_nom, $nouveau_prenom, $nouveau_tel, $nouveau_adresse, $nouveau_role  ]);


    if($finalinsert=== TRUE){
        header("Location: administrationgestionutilisateurs.php?id=<?=$user_id?>");
        exit();
    }

}            
      

?>

<?php
require 'header.php';
?>

<div class="conteneur1">

<H1 class="epeadministrateur" >ESPACE ADMINISTRATEUR</H1>
<div class="navbarresecond">
    <ul class="navsecond">
    <li><a href="administrationinfosperso.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">INFORMATIONS COMPTE</a></li>
    <li><a href="administrationgestionutilisateurs.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">GESTION DES TOUS LES COMPTES UTILISATEURS</a></li>
    </ul>
</div>

<h4 class="pstcommande"> REMPLIR LE FORMULAIRE POUR RAJOUTER UN UTILISATEUR</h4>

        <div class="resucom2">
                <form action="" method="POST">
                        
                    <div class="form-group">
                    <label for="nom4">Nom:</label>
                    <input type="text" name="nom4" id="nom4" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="prenom4">Prenom:</label>
                    <input type="text" id="prenom4" name="prenom4" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="tel4">Numero Mobile:</label>
                    <input type="tel4" id="tel4" name="tel4" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="email4">Email:</label>
                    <input type="email" id="email4" name="email4" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="mdp4">Mot de passe:</label>
                    <input type="password" id="mdp4" name="mdp4" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="adresse4">Adresse postale complete:</label>
                    <input type="text" id="adresse4" name="adresse4" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="role4">role:</label>
                    <input type="text" id="role4" name="role4" class="form-control" >
                    </div>
                    
                    
                    <button type="submit" class="btn btn-warning" id="creationespace" >CREER UTILISATEUR</button>
                    
                </form>
        </div>




<?php                
 require 'footer.php';
?>
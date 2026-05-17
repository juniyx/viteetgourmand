<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'] ?? '';

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$requete7= $pdo->prepare("SELECT id_utilisateur, nom, prenom, telephone, email, adresse_postale 
FROM utilisateur WHERE id_utilisateur =:idutil");
$requete7->bindvalue(':idutil', $user_id);
$requete7->execute();
$userrecup = $requete7->fetch();

if(isset($_POST['nom4'])&& isset($_POST['prenom4'])&& isset($_POST['tel4'])&& isset($_POST['email4']) && isset($_POST['adresse4']))
{

$modifnom = $_POST['nom4'];
$modifprenom = $_POST['prenom4'];
$modiftel= $_POST['tel4'];
$modifemail= $_POST['email4'];
$modifadresse =$_POST['adresse4'];


try {
    $requete8 = $pdo->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, telephone = :tel, email = :email, adresse_postale = :adresse 
                               WHERE id_utilisateur = :idutil");
    
    $requete8->execute([
        ':nom' => $modifnom,
        ':prenom' => $modifprenom,
        ':tel' => $modiftel,
        ':email' => $modifemail,
        ':adresse' => $modifadresse,
        ':idutil' => $user_id
    ]);
    
    echo "Mise à jour réussie !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

}




?>

<?php
require 'header.php';
?>
<div class="conteneur1">

<H1 class="epeutilisateur">ESPACE UTILISATEUR</H1>;


<div class="navbarresecond">
    <ul class="navsecond">
    <li><a href="esputicompte.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">INFORMATIONS COMPTE</a></li>
    <li><a href="esputicommandes.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">GESTION DES COMMANDES</a></li>
    <li><a href="esputisuivi.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">LE SUIVI DES COMMANDES ACCEPTEES</a></li>
    </ul>
</div>



<div class="infoperso">

    <div class="persoencours">
        <h3 class="persottr">MES COORDONNEES PERSONNELLES</h3>

        <div class="perso"> Nom : <?=$userrecup->nom ?></div>
        <div class="perso"> Prénom : <?=$userrecup->prenom?></div>
        <div class="perso"> Téléphone : <?=$userrecup->telephone ?></div>
        <div class="perso"> Email : <?=$userrecup->email?></div>
        <div class="perso"> Adresse Postale : <?=$userrecup->adresse_postale?></div>
        
    </div>

    <div class="modifinfo">

        <h3>MODIFIER MES COORDONNEES PERSONNELLES</h3>

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
                    <label for="adresse4">Adresse postale complete:</label>
                    <input type="text" id="adresse4" name="adresse4" class="form-control" >
                    </div>
                    
                    
                    <button type="submit" class="btn btn-warning" id="creationespace" >MODIFIER LES INFORMATIONS PERSONNELLES</button>
                    
                </form>
    </div>


</div>




<?php                
 require 'footer.php';
?>
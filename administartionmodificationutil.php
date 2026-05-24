<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];
$utilisateur_amodif= $_GET['idutilisateur'];

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$requete21 = $pdo->prepare("SELECT id_utilisateur, email, nom, prenom, telephone, adresse_postale, role 
FROM utilisateur  WHERE id_utilisateur =:idutil");
$requete21->bindvalue(':idutil', $utilisateur_amodif);
$requete21->execute();
$userrecup= $requete21->fetch();
?>

<?php
if(isset($_POST['nom4']) && isset($_POST['prenom4']) && isset($_POST['tel4']) && isset($_POST['email4']) && isset($_POST['adresse4']) && isset($_POST['role4']))
{

    $modifnom = $_POST['nom4'];
    $modifprenom = $_POST['prenom4'];
    $modiftel= $_POST['tel4'];
    $modifemail= $_POST['email4'];
    $modifadresse =$_POST['adresse4'];
    $modifrole =$_POST['role4'];


    try {
        $requete8 = $pdo->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, telephone = :tel, email = :email, adresse_postale = :adresse, role=:rol
        WHERE id_utilisateur = :idutil");
        
        $requete8->execute([
            ':nom' => $modifnom,
            ':prenom' => $modifprenom,
            ':tel' => $modiftel,
            ':email' => $modifemail,
            ':adresse' => $modifadresse,
            ':rol' => $modifrole,
            ':idutil' => $utilisateur_amodif
        ]);
        
        
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
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



<div class="infoperso">

    <div class="persoencours">
        <h2 class="pstcommande">MISE A JOUR DES INFORMATIONS DE L'UTILISATEUR</h2>
        

        <div class="perso"> Nom : <?=$userrecup->nom ?></div>
        <div class="perso"> Prénom : <?=$userrecup->prenom?></div>
        <div class="perso"> Téléphone : <?=$userrecup->telephone ?></div>
        <div class="perso"> Email : <?=$userrecup->email?></div>
        <div class="perso"> Adresse Postale : <?=$userrecup->adresse_postale?></div>
        <div class="perso"> role : <?=$userrecup->role?></div>
        
    </div>

    <div class="modifinfo">

        <h3>FAIRE LES MODIFICATIONS</h3>

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

                    <div class="form-group">
                    <label for="role4">role:</label>
                    <input type="text" id="role4" name="role4" class="form-control" >
                    </div>
                    
                    
                    <button type="submit" class="btn btn-warning" id="creationespace" >MODIFIER LES INFORMATIONS PERSONNELLES</button>
                    
                </form>
    </div>


</div>


<?php                
 require 'footer.php';
?>
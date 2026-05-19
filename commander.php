<?php
session_start();

$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';

$menu_idd= $_GET['menu'];
$user_id = $_SESSION['utilisateur_id'];

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);



$requete1 = $pdo->prepare("SELECT menu_id, titre, presentation, prix_parpersonne, nombre_personne_minimum FROM menu WHERE menu_id =:idmenu");
$requete1->bindvalue(':idmenu', $menu_idd);
$requete1->execute();
$menu= $requete1->fetch();

$requete2= $pdo->prepare("SELECT id_utilisateur, nom, prenom, telephone, email, adresse_postale FROM utilisateur WHERE id_utilisateur =:idutil");
$requete2->bindvalue(':idutil', $user_id);
$requete2->execute();
$utilisateurrecup = $requete2->fetch();
    

?>

<?php

if(isset($_POST['menuselector'])&& isset($_POST['nombrepers'])&& isset($_POST['adresselvr'])&& isset($_POST['datelvr']) && isset($_POST['heurelvr']))
{

    $com_menu = $_POST['menuselector'];
    $com_nbpers = $_POST['nombrepers'];
    $com_adresselivraison = $_POST['adresselvr'];
    $com_datelivraison = $_POST['datelvr'];
    $com_heurelivraison = $_POST['heurelvr'];
    $com_idtuilisateur = $utilisateurrecup->id_utilisateur;
    
    $com_date_commande = date('Y-m-d');

    $com_prix_menu = $com_nbpers * $menu->prix_parpersonne;
    $com_prix_livraison = 5;
    
    $requete3= $pdo->prepare("INSERT INTO commande (numero_commande, menu, nombre_personne, adresse_livraison, date_livraison, heure_livraison, prix_menu, date_commande, prix_livraison, statut, id_utilisateur)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,?,?) ");
    $finalinsert=$requete3->execute([NULL, $com_menu, $com_nbpers, $com_adresselivraison, $com_datelivraison, $com_heurelivraison, $com_prix_menu, $com_date_commande, $com_prix_livraison,NULL, $com_idtuilisateur ]);


    if($finalinsert=== TRUE){
        header("Location: resumecommande.php?id=$user_id");
        exit();

    }
} 

?>


<?php
require 'header.php';
?>

<div class="conteneur1">

<h2 class="ttrform">VEUILLEZ RENSEIGNER L'ENSEMBLE DES INFORMATIONS POUR LA REALISATION DE LA COMMANDE</h2>


<div class="formcommande">

    <form action="" method="POST">

        <h3 class="infoperso">INFORMATIONS PERSONELLES</h3>
        
            
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" class="form-control" value=<?=$utilisateurrecup->nom?>>
        </div>

        <div class="form-group">
            <label for="prenom">prenom:</label>
            <input type="text" id="prenom" name="prenom" class="form-control"  value=<?=$utilisateurrecup->prenom?> >
        </div>

        <div class="form-group">
            <label for="tel">Numero Mobile:</label>
            <input type="tel" id="tel" name="tel" class="form-control" value="<?=$utilisateurrecup->telephone?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?=$utilisateurrecup->email?>" >
        </div>

        <div class="form-group">
            <label for="adresse">Adresse postale complete:</label>
            <input type="text" id="adresse" name="adresse" class="form-control" value="<?=$utilisateurrecup->adresse_postale?>" >
        </div>



        <h3 class="commandeinfo">INFORMATIONS RELATIVES A LA COMMANDE</h3>
         
        <div class="form-group">
            <label for="menuselector">confirmez le menu souhaité:</label>
            <select id="menuselector" name="menuselector" class="form-control" value="<?=$menu->titre ?>">
                <option value="Menu du Moment">Menu du Moment</option>
                <option value="Menu de Noël">Menu de Noël</option>
                <option value="Menu de Pâques">Menu de Pâques</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nombrepers">Nombre de personnes (minimum 5):</label>
            <input type="text" id="nombrepers" name="nombrepers" class="form-control">
        </div>
        

        <div class="form-group">
            <label for="adresselvr">Adresse de livraison:</label>
            <input type="text" id="adresselvr" name="adresselvr" class="form-control">
        </div>

        <div class="form-group">
            <label for="datelvr">Date de livraison:</label>
            <input type="date" id="datelvr" name="datelvr" class="form-control">
        </div>
        <div class="form-group">
            <label for="heurelvr">Heure de livraison:</label>
            <input type="time" id="heurelvr" name="heurelvr" class="form-control">
        </div>


        <button type="submit" class="btn btn-success" id="confcommande" >CONFIRMER LA COMMANDE</button>
        

    </form>


</div>

<?php                
 require 'footer.php';
?>
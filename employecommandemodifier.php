<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];
$idcommande = $_GET['idcommande'];

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$requete18 = $pdo->prepare("SELECT numero_commande, menu, nombre_personne, adresse_livraison, date_livraison, heure_livraison, prix_menu, date_commande, prix_livraison, statut, id_utilisateur 
FROM commande  WHERE numero_commande = :idcommande");
$requete18->bindvalue(':idcommande', $idcommande);
$requete18->execute();
$commande = $requete18->fetch();
?>

<?php

if( isset($_POST['nommenu']) || isset($_POST['nombrepers']) || isset($_POST['prix']) || isset($_POST['adresselvr']) || isset($_POST['datelvr']) || isset($_POST['heurelvr'])|| isset($_POST['statut']))
{
    $com_nom = $_POST['nommenu'];
    $com_nbpers = $_POST['nombrepers'];
    $com_prix = $_POST['prix'];
    $com_adrlvr = $_POST['adresselvr'];
    $com_datelvr= $_POST['datelvr'];
    $com_heurelvr = $_POST['heurelvr'];
    $com_statut = $_POST['statut'];
    
        try {
            $requete12= $pdo->prepare("UPDATE commande SET menu =:nommenu, nombre_personne =:nombrepers, prix_menu=:prix, adresse_livraison =:adresselvr, date_livraison =:datelvr, heure_livraison =:heurelvr, statut =:statut
            WHERE numero_commande= :identifcommande"); 
            $requete12->execute([
                ':nommenu' => $com_nom,
                ':nombrepers' => $com_nbpers,
                ':prix' => $com_prix,
                ':adresselvr' => $com_adrlvr,
                ':datelvr' => $com_datelvr,
                ':heurelvr' => $com_heurelvr,
                ':statut' => $com_statut,
                ':identifcommande' =>$commande->numero_commande
            ]);
            
            
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }


    if($requete12 === TRUE){
        header("Location: employemenus.php?id=$user_id");
        exit();

    }
} 

?>





<?php
require 'header.php';
?>

<div class="conteneur1">

<H1 class="epeemploye">ESPACE EMPLOYE</H1>


<div class="navbarresecond">
    <ul class="navsecond">
    <li><a href="employecompte.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">INFORMATIONS COMPTE</a></li>
    <li><a href="employemenus.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">GESTION DES MENUS</a></li>
    <li><a href="employecommande.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">GESTION ET VALIDATION DES COMMANDES </a></li>
    <li><a href="employecomclients.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">TRAITEMENT DES COMMENTAIRES CLIENTS </a></li>
    </ul>
</div>



<div class="resucom">
   <div class="resumecommande">
    <h2 class="resumecommande"> voici le résumé de la commande :</h2>
    <div class="resumecommande"> Numéro de commande : <?=$commande->numero_commande ?></div>
    <div class="resumecommande"> Menu commandé : <?=$commande->menu?></div>
    <div class="resumecommande"> Nombre de personnes : <?=$commande->nombre_personne ?></div>
    <div class="resumecommande"> Prix du menu pour l'ensemble des personnes : <?= $commande->prix_menu?>€ TTC</div>
    <div class="resumecommande"> Date et Heure de livraison : <?=$commande->date_livraison?> / <?=$commande->heure_livraison ?></div>
    <div class="resumecommande"> Adresse de livraison : <?=$commande->adresse_livraison ?></div>
   </div>

    <div class="formcommande">

            <form action="" method="POST">

                <h3 class="commandeinfo"> FAIRE LES MODIFICATIONS</h3>
                
                <div class="form-group">
                    <label for="nommenu">Nom du Menu commandé:</label>
                    <input type="text" id="nommenu" name="nommenu" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombrepers">Nombre de personnes (minimum 5):</label>
                    <input type="text" id="nombrepers" name="nombrepers" class="form-control">
                </div>

                <div class="form-group">
                    <label for="prix">Prix à attribuer:</label>
                    <input type="number" id="prix" name="prix" class="form-control">
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

                <div class="form-group">
                    <label for="statut">statut de la commande :</label>
                    <input type="text" id="statut" name="statut" class="form-control">
                </div>


                <button type="submit" class="btn btn-success" id="confcommande" >MODIFIER LA COMMANDE</button>
                

            </form>

    </div>


</div>



<?php                
 require 'footer.php';
?>
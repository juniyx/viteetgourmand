<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'] ?? '';
$idcommande = $_GET['idcommande'] ?? '';
$menu_titre = $commande_amodifier->menu ?? '';

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);



$requete10 = $pdo->prepare("SELECT numero_commande, menu, nombre_personne, adresse_livraison, date_livraison, heure_livraison, prix_menu, date_commande, prix_livraison, statut, id_utilisateur 
FROM commande WHERE numero_commande =:idcommande ");
$requete10->bindvalue(':idcommande', $idcommande);
$requete10->execute();
$commande_amodifier = $requete10->fetch();

$requete11 = $pdo->prepare("SELECT menu_id, titre, presentation, prix_parpersonne, nombre_personne_minimum
FROM menu WHERE titre = :identifiantm");
$requete11->bindvalue(':identifiantm', $menu_titre);
$requete11->execute();
$menu = $requete11->fetch();




?>


<?php

if( isset($_POST['nombrepers']) || isset($_POST['adresselvr']) || isset($_POST['datelvr']) || isset($_POST['heurelvr']))
{
    $com_nbpers = $_POST['nombrepers'];
    $com_adresselivraison = $_POST['adresselvr'];
    $com_datelivraison = $_POST['datelvr'];
    $com_heurelivraison = $_POST['heurelvr'];
    
    
    
    $com_prix_livraison = 5;
    
        try {
            
            $requete12= $pdo->prepare("UPDATE commande SET nombre_personne =:nbpers, adresse_livraison =:adrliv, date_livraison =:datelvr, heure_livraison =:heurelvr 
            WHERE numero_commande = :numerocommande"); 
            $requete12->execute([
                ':nbpers' => $com_nbpers,
                ':adrliv' => $com_adresselivraison,
                ':datelvr' => $com_datelivraison,
                ':heurelvr' => $com_heurelivraison,
                ':numerocommande' => $commande_amodifier->numero_commande
            ]);
            
            
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }


    if($requete12 === TRUE){
        header("Location: espaceutilisateur.php?id=$user_id");
        exit();

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


<div class="resucom2">
   
  <div class="resumecommande2">
    <h4 class="resumecommande2"> LE RESUME DE VOTRE COMMANDE A MODIFIER</h4>
    <div class="resumecommande2"> Numéro de commande : <?=$commande_amodifier->numero_commande ?></div>
    <div class="resumecommande2"> Menu commandé : <?=$commande_amodifier->menu?></div>
    <div class="resumecommande2"> Nombre de personnes : <?=$commande_amodifier->nombre_personne ?></div>
    <div class="resumecommande2"> Prix du menu pour l'ensemble des personnes : <?= $commande_amodifier->prix_menu?>€ TTC</div>
    <div class="resumecommande2"> Date et Heure de livraison : <?=$commande_amodifier->date_livraison?> / <?=$commande_amodifier->heure_livraison ?></div>
    <div class="resumecommande2"> Adresse de livraison : <?=$commande_amodifier->adresse_livraison ?></div>
   </div>

    
   

    <form  action="" method="POST">

        <h4 class="commandeinfo"> VEUILLEZ RENSEIGNER LES MODIFICATIONS</h4>
         
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


        <button type="submit" class="btn btn-success" id="confcommande" >CONFIRMER LA MOFIFICATION DE LA COMMANDE</button>
   </form>

       

   

</div>

    










<?php                
 require 'footer.php';
?>
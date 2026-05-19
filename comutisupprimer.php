<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];
$idcommande = $_GET['idcommande'] ?? '';

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


$requete13= $pdo->prepare("DELETE FROM commande WHERE numero_commande =:numcommande");
$requete13->bindvalue(':numcommande', $idcommande);
$requete13->execute();

header("Location: esputicommandes.php?id=$user_id");
exit();

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


<h3 class="bnvuser" >Bienvenu <?= $userrecup->prenom ?></h3>

<h4 class="pstcommande">Voici la liste de vos dernières commandes </h4>
<?php
    foreach($commandesrecup as $unecommande) { ?>
     <div class="panneaucom" >
            <div class="rsmcommande"> 
            <div class="rsmcom"> Numéro de commande : <?=$unecommande->numero_commande ?></div>
            <div class="rsmcom"> Date commande : <?=$unecommande->date_commande?></div>
            <div class="rsmcom"> Menu commandé : <?=$unecommande->menu?></div>
            <div class="rsmcom"> Nombre de personnes : <?=$unecommande->nombre_personne ?></div>
            <div class="rsmcom"> Prix total du menu  : <?= $unecommande->prix_menu?>€ TTC</div>
            <div class="rsmcom"> Date et Heure de livraison : <?=$unecommande->date_livraison?></div>
            <div class="rsmcom"> Adresse de livraison : <?=$unecommande->adresse_livraison ?></div>
        </div>

            <img class="imgresumecom" src= "./images/repasnoel7.jpeg" width="75%" height="200px"></img>
        </div>
    <?php }?>
       
 

<?php                
 require 'footer.php';
?>
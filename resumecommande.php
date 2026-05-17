<?php
session_start();

$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';

$user_id= $_SESSION['utilisateur_id'];

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$requete4 = $pdo->prepare("SELECT numero_commande, menu, nombre_personne, adresse_livraison, date_livraison, heure_livraison, prix_menu, id_utilisateur FROM commande WHERE id_utilisateur =:idutil ORDER BY date_commande DESC LIMIT 1" );
$requete4->bindvalue(':idutil', $user_id);
$requete4->execute();
$commande= $requete4->fetch();

?>



<?php
require 'header.php';
?>
<div class="conteneur1">

<div class="resucom">
   <div class="resumecommande">
    <h5 class="resumecommandettr">Merci pour votre commande, vous pouvez suivre l'avancée de son traitement depuis votre espace utilisateur</h5>
    <h2 class="resumecommande"> voici le résumé de votre commande :</h2>
    <div class="resumecommande"> Numéro de commande : <?=$commande->numero_commande ?></div>
    <div class="resumecommande"> Menu commandé : <?=$commande->menu?></div>
    <div class="resumecommande"> Nombre de personnes : <?=$commande->nombre_personne ?></div>
    <div class="resumecommande"> Prix du menu pour l'ensemble des personnes : <?= $commande->prix_menu?>€ TTC</div>
    <div class="resumecommande"> Date et Heure de livraison : <?=$commande->date_livraison?> / <?=$commande->heure_livraison ?></div>
    <div class="resumecommande"> Adresse de livraison : <?=$commande->adresse_livraison ?></div>
   </div>

    <img class="imgresumecom" src= "./images/repaspaques6.jpeg" width="95%" height="350px"></img>


</div>


<?php                
 require 'footer.php';
?>
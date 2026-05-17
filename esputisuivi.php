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

$requete5= $pdo->prepare("SELECT id_utilisateur, nom, prenom, telephone, email, adresse_postale 
FROM utilisateur WHERE id_utilisateur =:idutil");
$requete5->bindvalue(':idutil', $user_id);
$requete5->execute();
$userrecup = $requete5->fetch();

$requete6 = $pdo->prepare("SELECT numero_commande, menu, nombre_personne, adresse_livraison, date_livraison, heure_livraison, prix_menu, date_commande, prix_livraison, statut, id_utilisateur 
FROM commande WHERE id_utilisateur =:idutil ORDER BY date_commande DESC LIMIT 30");
$requete6->bindvalue(':idutil', $user_id);
$requete6->execute();
$commandesrecup = $requete6->fetchAll();

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






<?php                
 require 'footer.php';
?>
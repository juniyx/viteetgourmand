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

<h1  class="vg">VITE & GOURMAND</h1>
<h3 class="bnvadm" >Bienvenu <?= $userrecup->prenom ?></h3>
<p></p>
<div class=imgbasdepage>
<img class="imgbasdepage2" src= "./images/repaspaques7.jpeg" width="80%" height="300px"></img>
</div>


<?php                
 require 'footer.php';
?>
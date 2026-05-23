<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];
$idmessage = $_GET['idmessage'];

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$requete19 = $pdo->prepare("SELECT id_message, titre, email, message_contact, date_message, statut_message
FROM contact WHERE id_message = $idmessage");
$requete19->execute();
$message = $requete19->fetch();
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

 <h4> voici les informations générales du Message client</h4>
 <h5>La réponse au client s'effectuera par l'email suivant qu'il a renseigné :<?=$message->email?></h5>


   <div class="resumessage">
    <div class="resumessageclient"> ID MESSAGE : <?=$message->id_message ?></div>
    <div class="resumessageclient"> TITRE: <?=$message->titre?></div>
    <div class="resumessageclient"> DATE : <?=$message->date_message ?></div>
    <div class="resumessageclient"> STATUT : <?= $message->statut_message?>€ TTC</div>
    <div class="resumessageclient"> MESSAGE : <?=$message->message_contact?></div>
    <div class="resumessageclient"> EMAIl : <?=$message->email?></div>
   </div>

    





<?php                
 require 'footer.php';
?>
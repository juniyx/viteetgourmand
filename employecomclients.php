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

$requete17 = $pdo->prepare("SELECT id_message, titre, email, message_contact, date_message, statut_message
FROM contact  ORDER BY date_message DESC LIMIT 50");
$requete17->execute();
$messages = $requete17->fetchAll();
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

<h4> voici la liste des messages clients en attente de réponses</h4>



<table  class="tablecommande" cellpadding="10" cellspacing="0">
                <thead class="entetetableau">
                    <tr>
                        <th>ID MESSAGE</th>
                        <th>TITRE</th>
                        <th>MESSAGE</th>
                        <th>DATE MESSAGE</th>
                        <th>STATUT</th>
                        <th>REPONDRE</th>
                        <th>SUPPRIMER</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?= htmlspecialchars($message->id_message) ?></td>
                        <td><?= htmlspecialchars($message->titre) ?></td>
                        <td><?= htmlspecialchars($message->message_contact) ?></td>
                        <td><?= htmlspecialchars($message->date_message) ?></td>
                        <td><?= htmlspecialchars($message->statut_message) ?></td>
                        <td><a href="employecomclientsreponse.php?id=<?=$user_id?>&idmessage=<?=$message->id_message?>" class="btn btn-warning" >REPONDRE</a></td>
                        <td><a href="employecomclientssupprimer.php?id=<?=$user_id?>&idmessage=<?=$message->id_message?>" class="btn btn-danger"  onclick="return confirm('Confirmer suppression ?')">SUPPRIMER</a> </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>





<?php                
 require 'footer.php';
?>
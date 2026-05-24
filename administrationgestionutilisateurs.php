<?php
session_start();
require 'header.php';
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

$requete20 = $pdo->prepare("SELECT id_utilisateur, email, nom, prenom, telephone, adresse_postale, role 
FROM utilisateur  ORDER BY id_utilisateur ASC LIMIT 500");
$requete20->execute();
$utilisateurs= $requete20->fetchAll();
?>

<div class="conteneur1">

<H1 class="epeadministrateur" >ESPACE ADMINISTRATEUR</H1>
<div class="navbarresecond">
    <ul class="navsecond">
    <li><a href="administrationinfosperso.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">INFORMATIONS COMPTE</a></li>
    <li><a href="administrationgestionutilisateurs.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">GESTION DES TOUS LES COMPTES UTILISATEURS</a></li>
    </ul>
</div>

<h4 class="pstcommande">GESTION DES UTILISATEURS</h4>


<div class="btnrajouter">
<a  href="administrationrajouterutil.php?id=<?=$user_id?>" class="btn btn-primary "  >RAJOUTER UN UTILISATEUR</a>
</div>

<table  class="tablecommande" cellpadding="10" cellspacing="0">
                <thead class="entetetableau">
                    <tr>
                        <th>ID UTILISATEUR</th>
                        <th>EMAIL</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>TELEPHONE</th>
                        <th>ADRESSE POSTALE</th>
                        <th>ROLE</th>
                        <th>MODIFIER</th>
                        <th>SUPPRIMER</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= htmlspecialchars($utilisateur->id_utilisateur) ?></td>
                        <td><?= htmlspecialchars($utilisateur->email) ?></td>
                        <td><?= htmlspecialchars($utilisateur->nom) ?></td>
                        <td><?= htmlspecialchars($utilisateur->prenom) ?></td>
                        <td><?= htmlspecialchars($utilisateur->telephone) ?></td>
                        <td><?= htmlspecialchars($utilisateur->adresse_postale) ?></td>
                        <td><?= htmlspecialchars($utilisateur->role) ?></td>
                        <td><a href="administartionmodificationutil.php?id=<?=$user_id?>&idutilisateur=<?=$utilisateur->id_utilisateur?>" class="btn btn-warning" >Modifier</a></td>
                        <td><a href="administrationsupprimerutil.php?id=<?=$user_id?>&idutilisateur=<?=$utilisateur->id_utilisateur?>" class="btn btn-danger"  onclick="return confirm('Confirmer suppression ?')">Supprimer</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>







<?php                
 require 'footer.php';
?>
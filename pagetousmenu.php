<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';

try {
   
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$requete = $pdo->query("SELECT menu_id, titre, presentation, prix_parpersonne, nombre_personne_minimum, image1 FROM menu");
$menus= $requete->fetchAll();

?>



<?php
require 'header.php';
?>
<div class="conteneur1">

<?php

foreach($menus as $menu) { ?>
<div class="portemenu">
    <img class="imgmenutous" src= "./images/<?= $menu->image1?>.jpeg" width="95%" height="350px"></img>
    <h2 class="ttrmenustous"><?=$menu->titre?></h2>
    <div class="presmenutous"><?=$menu->presentation ?></div>    
    <div  class="commandemenustous">
        <div class="minmenustous" >Le nombre minimum de personnes pour commander le menu est de : <?=$menu->nombre_personne_minimum ?></div>
        <div class="prixmenustous">Le prix par personne pour la commande de ce menu est de <?=$menu->prix_parpersonne?>€</div>
        <a  href="./pagemenu.php?menu=<?=$menu->menu_id?> " class="btn btn-outline-success" >LE MENU DETAILLE</a>
    </div>
</div>

<?php }?>

<?php                
require 'footer.php';
?>
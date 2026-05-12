<?php
session_start();

$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';

$menu_idd= $_GET['menu'];

$user_id = $_SESSION['utilisateur_id'] ?? '';

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$requete = $pdo->prepare("SELECT menu_id, titre, presentation, prix_parpersonne, nombre_personne_minimum, description, image1, image2, image3, image4, image5, image6, image7 FROM menu WHERE menu_id =:identifiantm");
$requete->bindvalue(':identifiantm', $menu_idd);
$requete->execute();
$menu= $requete->fetch();

?>



<?php
require 'header.php';
?>
<div class="conteneur1">


<h3 class="nom_menu"><?=$menu->titre?></h3>

<div class="panneau_menu">
    <div>
        <img src="./images/<?= $menu->image2?>.jpeg" width="95%" height="350px alt="">
    </div>

    <div>
        <div class="present_menu" ><?=$menu->presentation ?></div>
        <div class="prix_nombre" >Le nombre minimum de personnes pour commander est de <?=$menu->nombre_personne_minimum ?> pour un prix de <?=$menu->prix_parpersonne?>€ par personne.</div>
        <div class="descrip_menu"><?=$menu->description ?></div>
        
        <a href= <?php echo isset($_SESSION['utilisateur_id']) ? "commander.php?id=$user_id&menu=$menu_idd" : 'connexion.php?compte=creation'; ?> 
        class="btn btn-outline-success" id="commander">COMMANDER</a>
         
    </div>
</div>


<?php                
 require 'footer.php';
?>
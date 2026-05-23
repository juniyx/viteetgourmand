<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'] ?? '';
$idmenu= $_GET['idmenu'] ?? '';


    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


$requete11 = $pdo->prepare("SELECT menu_id, titre, presentation, prix_parpersonne, nombre_personne_minimum, description
FROM menu WHERE menu_id = :identifiantm");
$requete11->bindvalue(':identifiantm', $idmenu);
$requete11->execute();
$menu_amodifier = $requete11->fetch();




?>


<?php

if( isset($_POST['titre']) || isset($_POST['presentation']) || isset($_POST['prixparpersonne']) || isset($_POST['nbpersmin']) || isset($_POST['description']))
{
    $menu_titre = $_POST['titre'];
    $menu_presentation = $_POST['presentation'];
    $menu_prixparpersonne = $_POST['prixparpersonne'];
    $menu_nbpersmin= $_POST['nbpersmin'];
    $menu_description = $_POST['description'];
    
    
    
    
    
        try {
            $requete12= $pdo->prepare("UPDATE menu SET titre =:titre, presentation =:presentation,  prix_parpersonne =:prixparpersonne, nombre_personne_minimum =:npm, description=:dsp
            WHERE menu_id = :identifmenu"); 
            $requete12->execute([
                ':titre' => $menu_titre,
                ':presentation' => $menu_presentation,
                ':prixparpersonne' => $menu_prixparpersonne,
                ':npm' => $menu_nbpersmin,
                ':dsp' => $menu_description,
                ':identifmenu' =>$idmenu
            ]);
            
            
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }


    if($requete12 === TRUE){
        header("Location: employemenus.php?id=$user_id");
        exit();

    }
} 

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

<div class="resucom2">
   
  <div class="resumecommande2">
    <h4 class="resumecommande2"> LES CARACTERISTIQUES DU MENU</h4>
    <div class="resumecommande2"> TITRE: <?=$menu_amodifier->titre?></div>
    <div class="resumecommande2"> PRESENTATION : <?=$menu_amodifier->presentation?></div>
    <div class="resumecommande2"> PRIX PAR PERSONNE: <?=$menu_amodifier->prix_parpersonne?>€ TTC</div>
    <div class="resumecommande2"> NOMBRE DE PERSONNE MINIMUM: <?= $menu_amodifier->nombre_personne_minimum?></div>
    <div class="resumecommande2"> DESCRIPTION : <?=$menu_amodifier->description?></div>
   </div>

    
   

    <form  action="" method="POST">

        <h4 class="commandeinfo"> VEUILLEZ RENSEIGNER LES MODIFICATIONS</h4>
         
        <div class="form-group">
            <label for="titre">Titre:</label>
            <input type="text" id="titre" name="titre" class="form-control">
        </div>
        

        <div class="form-group">
            <label for="presentation">Presentation:</label>
            <input type="text" id="presentation" name="presentation" class="form-control">
        </div>

        <div class="form-group">
            <label for="prixparpersonne">prix par personne:</label>
            <input type="number" id="prixparpersonne" name="prixparpersonne" class="form-control">
        </div>

        <div class="form-group">
            <label for="nbpersmin">Nombre de personne minimum:</label>
            <input type="number" id="nbpersmin" name="nbpersmin" class="form-control">
        </div>

         <div class="form-group">
            <label for="">description</label>
            <input type="text" id="description" name="description" class="form-control">
        </div>


        <button type="submit" class="btn btn-success" id="confcommande" >CONFIRMER LA MODIFICATION DU MENU</button>
   </form>

       

   

</div>



<?php                
 require 'footer.php';
?>
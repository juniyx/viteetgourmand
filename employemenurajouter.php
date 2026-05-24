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

if( isset($_POST['titre']) && isset($_POST['presentation']) && isset($_POST['prixparpersonne']) && isset($_POST['nbpersmin']) && isset($_POST['description']))
{
    $menu_titre = $_POST['titre'];
    $menu_presentation = $_POST['presentation'];
    $menu_prixparpersonne = $_POST['prixparpersonne'];
    $menu_nbpersmin= $_POST['nbpersmin'];
    $menu_description = $_POST['description'];
    
    
    
    
    
        
    $requete3= $pdo->prepare("INSERT INTO menu (titre, presentation, prix_parpersonne, nombre_personne_minimum, description)
    VALUES(?, ?, ?, ?, ?) ");
    $finalinsert=$requete3->execute([$menu_titre, $menu_presentation, $menu_prixparpersonne, $menu_nbpersmin, $menu_description]);


    if($finalinsert=== TRUE){
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


<form  action="" method="POST">

        
         
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


        <button type="submit" class="btn btn-success" id="confcommande" >RAJOUTER LE MENU</button>
   </form>

</div>


   <?php                
 require 'footer.php';
?>
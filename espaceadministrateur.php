<?php
session_start();
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



<?php                
 require 'footer.php';
?>
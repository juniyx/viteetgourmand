<?php
session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>


<?php
require 'elements/header.php';
?>
<div class="conteneur1">

<H1 class="epeemploye">ESPACE EMPLOYE</H1>


<div class="navbarresecond">
    <ul class="navsecond">
    <li><a href="" style="text-decoration:none" class="liensecond">INFORMATIONS COMPTE</a></li>
    <li><a href="" style="text-decoration:none" class="liensecond">GESTION DES MENUS</a></li>
    <li><a href="" style="text-decoration:none" class="liensecond">GESTION ET VALIDATION DES COMMANDES </a></li>
    <li><a href="" style="text-decoration:none" class="liensecond">GESTION DES AVIS CLIENTS</a></li>
    </ul>
</div>





<?php                
 require 'elements/footer.php';
?>
<?php
session_start();
unset($_SESSION['role']);
unset($_SESSION['utilisateur_id']);
header("Location: index.php");
exit();
?>
<?php
require 'header.php';
?>
<div class="conteneur1">

<?php                
 require 'footer.php';
?>
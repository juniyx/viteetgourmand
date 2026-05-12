
<?php

$notifconfmail= 'false';

if(isset($_POST['email'])){
   $notifconfmail='true';
}

?>


<?php
require 'header.php';
?>
<div class="conteneur1">

<div class="conteneurrein">

         <?php if($notifconfmail ==='true') { ?>
        <div class="alert alert-success">Merci, nos services ont envoyé la procedure de reinitialisation du mot de passe par Email.</div>
        <?php } ?>
        <h3 class="ttrrei">Veuillez communiquer votre Email</h3>
        <p class="prei">Vite&Gourmand va vous envoyer un email avec un lien permettant de recreer un mot de passe valide.</p>

        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" >
            </div>

            <button id="tseemail" type="submit" class="btn btn-warning" >TRANSMETTRE EMAIL</button>
        </form>
</div>


<?php                
 require 'footer.php';
?>

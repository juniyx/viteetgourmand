<?php
require 'elements/header.php';
?>
<div class="conteneur1">

<div class="conteneurrein">

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
 require 'elements/footer.php';
?>

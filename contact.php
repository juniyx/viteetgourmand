<?php
require 'header.php';
?>
<div class="conteneur1">

<h2 class="ttrcontact">VEUILLEZ NOUS CONTACTER VIA CE FORMULAIRE</h2>

<div class="formcontact">

    <form action="" method="POST">
            
        <div class="form-group">
            <label for="nom">Titre:</label>
            <input type="text" name="nom" id="nom" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" >
        </div>

        <div class="form-group">
            <label for="nom">Message:</label>
            <textarea type="text" name="message" id="message" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success" id="confcontact" >ENVOYER LE MESSAGE </button>
        
    </form>

</div>

<?php                
 require 'footer.php';
?>
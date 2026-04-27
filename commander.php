<?php
require 'elements/header.php';
?>

<div class="conteneur1">

<h2 class="ttrform">VEUILLEZ RENSEIGNER L'ENSEMBLE DES INFORMATIONS POUR LA REALISATION DE LA COMMANDE</h2>


<div class="formcommande">

    <form action="" method="POST">

        <h3 class="infoperso">INFORMATIONS PERSONELLES</h3>
        
            
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" class="form-control">
        </div>

        <div class="form-group">
            <label for="prenom">prenom:</label>
            <input type="text" id="prenom" name="prenom" class="form-control" >
        </div>

        <div class="form-group">
            <label for="tel">Numero Mobile:</label>
            <input type="tel" id="tel" name="tel" class="form-control" >
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" >
        </div>

        <div class="form-group">
            <label for="adresse">Adresse postale complete:</label>
            <input type="text" id="adresse" name="adresse" class="form-control" >
        </div>



        <h3 class="commandeinfo">INFORMATIONS RELATIVES A LA COMMANDE</h3>
         
        <div class="form-group">
            <label for="menuselector">confirmez le menu souhaité:</label>
            <select id="menuselector" name="menuselector" class="form-control">
                <option value="menumoment">Menu du Moment</option>
                <option value="menunoel">Menu de Noël</option>
                <option value="menupaques">Menu de Pâques</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nombrepers">Nombre de personnes (minimum 5):</label>
            <input type="text" id="nombrepers" name="nombrepers" class="form-control">
        </div>
        

        <div class="form-group">
            <label for="adresselvr">Adresse de livraison:</label>
            <input type="text" id="adresselvr" name="adresselvr" class="form-control">
        </div>

        <div class="form-group">
            <label for="datelvr">Date de livraison:</label>
            <input type="date" id="datelvr" name="datelvr" class="form-control">
        </div>
        <div class="form-group">
            <label for="heurelvr">Heure de livraison:</label>
            <input type="time" id="heurelvr" name="heurelvr" class="form-control">
        </div>


        <button type="submit" class="btn btn-success" id="confcommande" >CONFIRMER LA COMMANDE</button>
        

    </form>


</div>

<?php                
 require 'elements/footer.php';
?>
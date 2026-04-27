<?php
require 'elements/header.php';
?>
<div class="conteneur1">

<h2 class="ttrconnexion">CONNEXION</h2>


<div class="conteneurconnexions">

    <div class="formconnexion1">

        <h5 class="creationcompte">VEUILLEZ COMPLETER LES INFORMATIONS DEMANDEES POUR LA CREATION D'UN COMPTE UTILISATEUR </h5>
        <p class="creationinfo">Si vous ne disposez pas de compte, veuillez completer le formulaire.Par la suite vous disposerez d'un espace utilisateur afin de réaliser vos commandes.</p>
                <form action="" method="POST">
                        
                    <div class="form-group">
                    <label for="nom1">Nom:</label>
                    <input type="text" name="nom1" id="nom1" class="form-control">
                    </div>

                    <div class="form-group">
                    <label for="prenom1">Prenom:</label>
                    <input type="text" id="prenom1" name="prenom1" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="tel1">Numero Mobile:</label>
                    <input type="tel1" id="tel1" name="tel1" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="email1">Email:</label>
                    <input type="email" id="email1" name="email1" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="mdp1">Mot de Passe:</label>
                    <input type="password" id="mdp1" name="mdp1" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="adresse1">Adresse postale complete:</label>
                    <input type="text" id="adresse1" name="adresse1" class="form-control" >
                    </div>
                    
                    
                    <button type="submit" class="btn btn-dark" id="creationespace" >ENVOYER LES INFORMATIONS POUR LA CREATION DU COMPTE </button>
                    
                </form>
    </div>


    <div class="formconnexion2">

                <h5 class="seconnecter">SE CONNECTER A SON ESPACE UTILISATEUR</h5>
                <p class="seconinfo"> renseignez vos identifiants pour accéder à votre espace utilisateur.</p>

                <form action="" method="POST">
                        
                    <div class="form-group">
                    <label for="email2">Email:</label>
                    <input type="email" id="email2" name="email2" class="form-control" >
                    </div>

                    <div class="form-group">
                    <label for="mdp2">Mot de Passe:</label>
                    <input type="password" id="mdp2" name="mdp2" class="form-control" >
                    </div>

                    <button type="submit" class="btn btn-dark" id="connexionutilisateur">CONNEXION</button>
                    
                </form>

    </div>

</div>




<?php                
 require 'elements/footer.php';
?>
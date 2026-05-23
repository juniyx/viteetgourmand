<?php
if(session_status()=== PHP_SESSION_NONE){
  session_start();
};

$user_id= $_SESSION['utilisateur_id'] ?? '' ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vite&Gourmand</title>
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="codejavascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>   
</head>

<body>

  <div class="gdconteneur">
            <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Vite&Gourmand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">ACCUEIL</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">A PROPOS</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            LES MENUS
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="pagetousmenu.php">Tous les Menus</a></li>
            <li><a class="dropdown-item" href="pagemenu.php?menu=11">Menu du Moment</a></li>
            <li><a class="dropdown-item" href="pagemenu.php?menu=12">Menu de Noël</a></li>
            <li><a class="dropdown-item" href="pagemenu.php?menu=13">Menu de Pâques</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">CONTACT</a>
        </li>
      </ul>

      <?php
      

      if(isset($_SESSION['utilisateur_id']) && $_SESSION['utilisateur_role']==='utilisateur'){?>
       <a href="espaceutilisateur.php?id=<?=$user_id?>" class="btn btn-outline-secondary"  >ESPACE UTILISATEUR</a>
       <?php }elseif(isset($_SESSION['utilisateur_id']) && $_SESSION['utilisateur_role']==='employe') {?> 
        <a href="espaceemploye.php?id=<?=$user_id?>" class="btn btn-outline-secondary" >ESPACE EMPLOYE</a>  
      <?php } elseif (isset($_SESSION['utilisateur_id']) && $_SESSION['utilisateur_role']==='administrateur'){?> 
        <a href="espaceadministrateur.php?id=<?=$user_id?>" class="btn btn-outline-secondary" >ESPACE ADMINISTRATEUR</a>   
        <?php }?>
      
      <?php
      if(!empty($_SESSION['utilisateur_id'])) { ?>
      <a href="deconnexion.php" class="btn btn-outline-secondary">SE DECONNECTER</a>
      <?php } elseif(empty($_SESSION['utilisateur_id'])) {?>
      <form class="d-flex" role="search">
       <a href="connexion.php" class="btn btn-outline-danger">CONNEXION</a>
      </form> 
      <?php } ?>

      
      


    </div>
  </div>
</nav>


               
                
                <div class="imgacceuil">
                <img class="imgacceuil2" src="./images/repaspresentation4.jpg" width="100%" height="350px"></img>
                </div>
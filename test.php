<?php

$heuredumoment=date('Y-m-d');
echo $heuredumoment;

session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';


$modifnom = $_POST['nom4'];
$modifprenom = $_POST['prenom4'];
$modiftel= $_POST['tel4'];
$modifemail= $_POST['email4'];
$modifadresse =$_POST['adresse4'];



$requete8= $pdo->prepare("UPDATE utilisateur SET  nom = $modifnom, prenom= $modifprenom, telephone=$modiftel, email=$modifemail, adresse_postale=$modifadresse
WHERE id_utilisateur =:idutil");
$requete8->bindvalue(':idutil', $user_id);
$requete8->execute();

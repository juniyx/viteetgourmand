<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];
$idcommande = $_GET['idcommande'] ?? '';

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


$requete13= $pdo->prepare("DELETE FROM commande WHERE numero_commande =:idcommande");
$requete13->bindvalue(':idcommande', $idcommande);
$requete13->execute();

header("Location: employecommande.php?id=$user_id");
exit();

?>
<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];
$utilisateur_asupp = $_GET['idutilisateur'] ?? '';

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


$requete13= $pdo->prepare("DELETE FROM utilisateur WHERE id_utilisateur =:iduti");
$requete13->bindvalue(':iduti', $utilisateur_asupp );
$requete13->execute();

header("Location: administrationgestionutilisateurs.php?id=<?=$user_id?>");
exit();

?>
<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];

if(!empty($_POST['titre']) && !empty($_POST['email3']) && !empty($_POST['message']) ) 
{

    $host = 'localhost';
    $dbname = 'vitegourmand';
    $username = 'root';
    $password = '';

    $message_titre = $_POST['titre'];
    $message_email = $_POST['email3'];
    $message_contact = $_POST['message'];
    

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        
        $requete16 = $pdo->prepare("INSERT INTO contact (id_message, titre, email, message_contact)
        VALUES(?, ?, ?, ?) ");
        $requete16->execute([NULL, $message_titre, $message_email , $message_contact]);

        
    } catch(PDOException $e) {
        error_log($e->getMessage());
        echo 'Erreur de connexion à la base de données';
    }
    


}
?>


<?php
require 'header.php';
?>
<div class="conteneur1">

<h2 class="ttrcontact">VEUILLEZ NOUS CONTACTER VIA CE FORMULAIRE</h2>

<div class="formcontact">

    <form action="" method="POST">
            
        <div class="form-group">
            <label for="titre">Titre:</label>
            <input type="text" name="titre" id="titre" class="form-control">
        </div>

        <div class="form-group">
            <label for="email3">Email:</label>
            <input type="email" id="email3" name="email3" class="form-control" >
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea type="text" name="message" id="message" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success" id="confcontact" >ENVOYER LE MESSAGE </button>
        
    </form>

</div>

<?php                
 require 'footer.php';
?>
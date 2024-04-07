<?php 

require_once('./config.php');

session_start();

$sql = "DELETE FROM users WHERE email = ?";

if($statement = $connection->prepare($sql)){
     $statement->bind_param("s", $email);

    //$email = $_POST['email'];
    $email = $_SESSION['email'];
    
    $statement->execute();
  
    //echo "Email " . $email . "eliminata con successo";
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$statement->close();
$connection->close();

?>

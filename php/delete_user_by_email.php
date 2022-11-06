<?php 

require_once('./config.php');

$sql = "DELETE FROM users WHERE email = ?";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("s", $email);

    $email = $_POST['email'];

    $statement->execute();
  
    // echo "Registrazione effettuata con successo";
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$statement->close();
$connection->close();

?>
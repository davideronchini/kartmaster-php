<?php 

require_once('./config.php');

$sql = "INSERT INTO users (email, username, password, wins, pole_positions, podiums) VALUES (?, ?, ?, ?, ?, ?)";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("sssiii", $email, $username, $password, $wins, $pole_positions, $podiums);

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $wins = 0;
    $pole_positions = 0;
    $podiums = 0;

    $statement->execute();
    
    header("location: ../index.php#login-popup");
  
    // echo "Registrazione effettuata con successo";
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$statement->close();
$connection->close();

?>
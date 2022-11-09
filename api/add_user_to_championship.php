<?php 

require_once('./config.php');

$sql = "INSERT INTO users_championships (id_user, id_championship) VALUES (?, ?)";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("ii", $id_user, $id_championship);

    $id_user = $_POST['id_user'];
    $id_championship = $_POST['id_championship'];
    
    $statement->execute();

    $statement->close();
  
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$connection->close();

?>
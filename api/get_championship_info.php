<?php

require_once("./config.php");

$sql = "SELECT COUNT(*) FROM races WHERE id_championship = ?";

$data;
if($statement = $connection->prepare($sql)){
    $statement->bind_param("i", $id);

    $id = $_POST['id_championship'];

    $statement->execute();

    $result = $statement->get_result();
    $data['races'] = $result->fetch_array(MYSQLI_ASSOC)['COUNT(*)'];
}else {
    echo "Errore nell'esecuzione di $sql. " . $connection->error;
}

$sql = "SELECT COUNT(*) FROM users
INNER JOIN users_championships ON users.id = users_championships.id_user
INNER JOIN championships ON championships.id = users_championships.id_championship WHERE championships.id = ?";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("i", $id);

    $id = $_POST['id_championship'];
    
    $statement->execute();

    $result = $statement->get_result();
    $data['participants'] = $result->fetch_array(MYSQLI_ASSOC)['COUNT(*)'];

    
}else {
    echo "Errore nell'esecuzione di $sql. " . $connection->error;
}

echo json_encode($data); 

$statement->close();
$connection->close();

?>
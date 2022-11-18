<?php 

require_once('./config.php');

$sql = "UPDATE races SET id_circuit = ? WHERE id = ?";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("ii", $id_circuit, $id_race);

    $id_circuit = $_POST['id_circuit'];
    $id_race = $_POST['id_race'];

    $statement->execute();
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$statement->close();
$connection->close();

?>
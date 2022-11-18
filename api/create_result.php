<?php 

require_once('./config.php');

$sql = "INSERT INTO results (owner_email, best_time, starting_position, arrival_position, points, id_race) VALUES (?, ?, ?, ?, ?, ?)";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("ssiiii", $owner_email, $best_time, $starting_position, $arrival_position, $points, $id_race);

    $owner_email = $_POST['owner_email'];
    $best_time = $_POST['best_time'];
    $starting_position = $_POST['starting_position'];
    $arrival_position = $_POST['arrival_position'];
    $points = $_POST['points'];
    $id_race = $_POST['id_race'];

    $statement->execute();

    $statement->close();
    
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$connection->close();

?>
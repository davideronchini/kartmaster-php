<?php

require_once("./config.php");

$sql = "SELECT users.id AS id_user, users.email, users.username, users.wins, users.pole_positions, users.podiums,championships.id AS id_championship, championships.name, championships.date FROM users
INNER JOIN users_championships ON users.id = users_championships.id_user AND users.email = ?
INNER JOIN championships ON championships.id = users_championships.id_championship;";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("s", $email);

    $email = $_POST['email'];

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tmp;
            $tmp['id'] = $row['id_championship'];
            $tmp['name'] = $row['name'];
            $tmp['races'] = 0;
            $tmp['position'] = 0;
            $tmp['participants'] = 0;
            
            array_push($data, $tmp);
        }

        echo json_encode($data);
    }else {
        echo "Non ci sono righe disponibili";
    }

    $statement->close();
}else {
    echo "Errore nell'esecuzione di $sql. " . $connection->error;
}

$connection->close();

?>
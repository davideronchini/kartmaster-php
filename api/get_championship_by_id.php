<?php

require_once("./config.php");

$sql = "SELECT users.id AS user_id, users.email, users.username, championships.id AS championship_id, championships.name, championships.date FROM users
INNER JOIN users_championships ON users.id = users_championships.id_user
INNER JOIN championships ON championships.id = ? AND championships.id = users_championships.id_championship; ";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("i", $id);

    $id = $_POST['most_recent_championship_id'];

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tmp;
            $tmp['user_id'] = $row['user_id'];
            $tmp['email'] = $row['email'];
            $tmp['username'] = $row['username'];
            $tmp['championship_id'] = $row['championship_id'];
            $tmp['name'] = $row['name'];
            $tmp['date'] = $row['date'];
            
            array_push($data, $tmp);
        }

        echo json_encode($data);
    }else {
        echo "Non ci sono righe disponibili";
    }
}else {
    echo "Errore nell'esecuzione di $sql. " . $connection->error;
}

$statement->close();
$connection->close();

?>
<?php

require_once("./config.php");

$sql = "SELECT championships.id AS id_championship, championships.name, championships.date FROM users
INNER JOIN users_championships ON users.id = users_championships.id_user AND users.email = ?
INNER JOIN championships ON championships.id = users_championships.id_championship AND date=(SELECT MAX(date) FROM championships);";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("s", $email);

    $email = $_POST['email'];

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tmp;
            $tmp['id_championship'] = $row['id_championship'];
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
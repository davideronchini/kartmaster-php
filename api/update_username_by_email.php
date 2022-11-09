<?php

use LDAP\Result;

require_once("./config.php");

$sql = "UPDATE users SET username = ? WHERE email = ?";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("ss", $username, $email);

    $username = $_POST['username'];
    $email = $_POST['email'];

    $statement->execute();

    $result = $statement->get_result();

    $statement->close();
}else {
    echo "Errore nell'esecuzione di $sql. " . $connection->error;
}

$sql = "SELECT * FROM users WHERE email = ?";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("s", $email);

    $email = $_POST['email'];

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tmp;
            $tmp['id'] = $row['id'];
            $tmp['email'] = $row['email'];
            $tmp['username'] = $row['username'];
            $tmp['wins'] = $row['wins'];
            $tmp['pole_positions'] = $row['pole_positions'];
            $tmp['podiums'] = $row['podiums'];
            
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
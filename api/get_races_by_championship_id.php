<?php

require_once("./config.php");

$sql = "SELECT * FROM races INNER JOIN results ON results.id_race = races.id WHERE races.id_championship = ? AND results.owner_email = ?";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("is", $id, $email);

    $id = $_POST['id'];
    $email = $_POST['email'];

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tmp;
            $tmp['id'] = $row['id'];
            $tmp['name'] = $row['name'];
            $tmp['date'] = $row['date'];
            $tmp['id_circuit'] = $row['id_circuit'];
            
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
<?php

require_once("./config.php");

$wins = 0;
$pole_positions = 0;
$podiums = 0;

$sql = "SELECT * FROM races INNER JOIN results ON results.id_race = races.id WHERE results.owner_email = ?";

$data;
if($statement = $connection->prepare($sql)){
    $statement->bind_param("s", $email);

    $email = $_POST['email'];

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            if ($row['starting_position'] == 1) $pole_positions++;
            if ($row['arrival_position'] >= 1 && $row['arrival_position'] <= 3) $podiums++;
            if ($row['arrival_position'] == 1) $wins++;
        }

        $data['wins'] = $wins;
        $data['pole_positions'] = $pole_positions;
        $data['podiums'] = $podiums; 

        echo json_encode($data);
    }else {
        echo "Non ci sono righe disponibili";
    }
    
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
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            if ($row['wins'] != $wins || $row['pole_positions'] != $pole_positions || $row['podiums'] != $podiums){
                $sql = "UPDATE users SET wins = ?, pole_positions = ?, podiums = ? WHERE email = ?";

                if($statement = $connection->prepare($sql)){
                    $statement->bind_param("iiis", $w, $pp, $p, $email);
                
                    $w = $wins;
                    $pp = $pole_positions;
                    $p = $podiums;
                    $email = $_POST['email'];
                
                    $statement->execute();
                
                    $statement->close();
                }else {
                    echo "Errore nell'esecuzione di $sql. " . $connection->error;
                }
            }
        }
    }else {
        echo "Non ci sono righe disponibili";
    }
}else {
    echo "Errore nell'esecuzione di $sql. " . $connection->error;
}

$statement->close();
$connection->close();

?>
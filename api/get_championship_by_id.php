<?php

require_once("./config.php");

$sql = "SELECT users.id AS id_user, users.email, users.username, championships.id AS id_championship, championships.name, championships.date FROM users
INNER JOIN users_championships ON users.id = users_championships.id_user
INNER JOIN championships ON championships.id = ? AND championships.id = users_championships.id_championship;";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("i", $id);

    $id = $_POST['id_championship'];

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tmp;
            $tmp['id_user'] = $row['id_user'];
            $tmp['email'] = $row['email'];
            $tmp['username'] = $row['username'];
            $tmp['id_championship'] = $row['id_championship'];
            $tmp['name'] = $row['name'];
            $tmp['date'] = $row['date'];            

            $sql = "SELECT * FROM races INNER JOIN results ON results.id_race = races.id WHERE races.id_championship = ? AND results.owner_email = ?";

            $points = 0;
            if($statement1 = $connection->prepare($sql)){
                $statement1->bind_param("is", $id1, $owner_email);

                $id1 = $row['id_championship'];
                $owner_email = $row['email'];

                $statement1->execute();
                $result1 = $statement1->get_result();
                if ($result1->num_rows > 0){
                    while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
                        $points += $row1['points'];
                    }
                }

                $statement1->close();
            }

            $tmp['points'] = $points;
            
            array_push($data, $tmp);
        }

        // Sort the array by points
        usort($data, function ($item1, $item2) {
            return $item1['points'] <=> $item2['points'];
        });
        // Reverse the array
        $data = array_reverse($data);
        
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
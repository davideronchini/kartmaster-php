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
            //TODO: fai un for dove scorri l'array di records della tabella result dove sommi i punti dei record con attributo email = $row['email']
            $points = 0;

            $sql = "SELECT owner_email, points FROM results WHERE id = (SELECT id FROM races WHERE id_championship = ?) AND owner_email = ?";

            if($statement = $connection->prepare($sql)){
                $statement->bind_param("is", $id, $owner_email);

                $id = $row['id_championship'];
                $owner_email = $row['email'];

                $statement->execute();

                $result = $statement->get_result();
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                        $points += $row['points'];
                    }
                }else {
                    echo "Non ci sono righe disponibili -> $sql. ";
                }
            }else {
                echo "Errore nell'esecuzione di $sql. " . $connection->error;
            }

            $tmp['points'] = $points;
            
            array_push($data, $tmp);
        }

        // Sort the array by points
        usort($data, fn($a, $b) => $a['points'] <=> $b['points']);
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
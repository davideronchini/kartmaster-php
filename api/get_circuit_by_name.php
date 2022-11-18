<?php

require_once("./config.php");

$sql = "SELECT * FROM circuits WHERE name = ?";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("s", $name);

    $name = $_POST['name'];

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tmp;
            $tmp['id'] = $row['id'];
            $tmp['name'] = $row['name'];
            $tmp['image'] = base64_encode($row['image']);
            $tmp['vote'] = $row['vote'];
            
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
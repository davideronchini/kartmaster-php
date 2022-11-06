<?php 

require_once('./config.php');

$sql = "INSERT INTO championships (name) VALUES (?);";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("s", $name);

    $name = $_POST['new_championship_name'];
    
    $statement->execute();

    $sql = "SELECT * FROM championships WHERE id = LAST_INSERT_ID();";

    if($statement = $connection->prepare($sql)){
    
        $statement->execute();

        $result = $statement->get_result();
        if ($result->num_rows > 0){
            $data = [];
            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                $tmp;
                $tmp['id'] = $row['id'];
                $tmp['name'] = $row['name'];
                $tmp['date'] = $row['date'];
                
                array_push($data, $tmp);
            }

            echo json_encode($data);
        }else {
            echo "Non ci sono righe disponibili";
        }
    }

    $statement->close();
  
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$connection->close();

?>
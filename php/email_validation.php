<?php 

require_once('config.php');

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
            $tmp['exists'] = true;
            $tmp['id'] = $row['id'];
            $tmp['username'] = $row['username'];

            array_push($data, $tmp);
        }

        echo json_encode($data);
    }else{
        echo "Non esistono account con questa email";
    }

    $statement->close();
}else {
    echo "Errore durante la ricerca";
}

$connection->close();

?>
<?php 

require_once('config.php');

$sql = "SELECT * FROM `circuits` WHERE country = \"Valle d'Aosta\" UNION
SELECT * FROM `circuits` WHERE country = \"Piemonte\" UNION
SELECT * FROM `circuits` WHERE country = \"Liguria\" UNION
SELECT * FROM `circuits` WHERE country = \"Lombardia\" UNION
SELECT * FROM `circuits` WHERE country = \"Trentino Alto Adige\" UNION
SELECT * FROM `circuits` WHERE country = \"Veneto\" UNION
SELECT * FROM `circuits` WHERE country = \"Friuli Venezia Giulia\" UNION
SELECT * FROM `circuits` WHERE country = \"Emilia Romagna\" UNION
SELECT * FROM `circuits` WHERE country = \"Toscana\" UNION
SELECT * FROM `circuits` WHERE country = \"Umbria\" UNION
SELECT * FROM `circuits` WHERE country = \"Marche\" UNION
SELECT * FROM `circuits` WHERE country = \"Lazio\" UNION
SELECT * FROM `circuits` WHERE country = \"Abruzzo\" UNION
SELECT * FROM `circuits` WHERE country = \"Molise\" UNION
SELECT * FROM `circuits` WHERE country = \"Campania\" UNION
SELECT * FROM `circuits` WHERE country = \"Puglia\" UNION
SELECT * FROM `circuits` WHERE country = \"Basilicata\" UNION
SELECT * FROM `circuits` WHERE country = \"Calabria\" UNION
SELECT * FROM `circuits` WHERE country = \"Sicilia\" UNION
SELECT * FROM `circuits` WHERE country = \"Sardegna\"";

if($statement = $connection->prepare($sql)){

    $statement->execute();

    $result = $statement->get_result();
    if ($result->num_rows > 0){
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $tmp;
            $tmp['id'] = $row['id'];
            $tmp['name'] = $row['name'];
            $tmp['country'] = $row['country'];

            array_push($data, $tmp);
        }

        echo json_encode($data);
    }else {
        echo "Non ci sono righe disponibili";
    }
}else {
    echo "Errore in fase di login";
}

$statement->close();
$connection->close();

?>
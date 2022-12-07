<?php 

require_once('./config.php');

$hidden_championships_count = 0;
$all_championships_count = 0;

$sql = "SELECT COUNT(*) FROM users_championships WHERE id_championship = ? AND visible = 0";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("i", $id_championship);

    $id_championship = $_POST['id_championship'];

    $statement->execute();

    $result = $statement->get_result();
    $hidden_championships_count = $result->fetch_array(MYSQLI_ASSOC)['COUNT(*)'];
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$sql = "SELECT COUNT(*) FROM users_championships WHERE id_championship = ?";

if($statement = $connection->prepare($sql)){
    $statement->bind_param("i", $id_championship);

    $id_championship = $_POST['id_championship'];

    $statement->execute();

    $result = $statement->get_result();
    $all_championships_count = $result->fetch_array(MYSQLI_ASSOC)['COUNT(*)'];
}else {
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

if ($all_championships_count == $hidden_championships_count + 1){
    // Find all the races of the selected championship
    $sql = "SELECT * FROM races WHERE id_championship = ?";

    if($statement = $connection->prepare($sql)){
        $statement->bind_param("i", $id_championship);

        $id_championship = $_POST['id_championship'];

        $statement->execute();

        $result = $statement->get_result();
        if ($result->num_rows > 0){
            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                // Delete all the results of the array of races
                $sql = "DELETE FROM results WHERE id_race = ?";

                if($statement = $connection->prepare($sql)){
                    $statement->bind_param("i", $id_race);

                    $id_race = $row['id'];

                    $statement->execute();

                }else {
                    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
                }

                // Delete the race
                $sql = "DELETE FROM races WHERE id = ?";

                if($statement = $connection->prepare($sql)){
                    $statement->bind_param("i", $id_race);

                    $id_race = $row['id'];

                    $statement->execute();

                }else {
                    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
                }
            }

        }else {
            echo "Non ci sono righe disponibili";
        }
    }else {
        echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
    }

    // Delete the championship
    $sql = "DELETE FROM championships WHERE id = ?";

    if($statement = $connection->prepare($sql)){
        $statement->bind_param("i", $id_championship);

        $id_championship = $_POST['id_championship'];

        $statement->execute();

    }else {
        echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
    }

    // Delete the relationship between the user and the championship
    $sql = "DELETE FROM users_championships WHERE id_championship = ?";

    if($statement = $connection->prepare($sql)){
        $statement->bind_param("i", $id_championship);

        $id_championship = $_POST['id_championship'];

        $statement->execute();

    }else {
        echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
    }

}else {
    // Change the championship visibility to false (0) for this user
    $sql = "UPDATE users_championships SET visible = 0 WHERE id_user = ? AND id_championship = ?";

    if($statement = $connection->prepare($sql)){
        $statement->bind_param("ii", $id_user, $id_championship);

        $id_user = $_POST['id_user'];
        $id_championship = $_POST['id_championship'];

        $statement->execute();

    }else {
        echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
    }
}

header("location: ../championships.php");

$statement->close();
$connection->close();

?>
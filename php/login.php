<?php 

require_once('config.php');

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $sql = "SELECT * FROM users WHERE email = ?";

    if($statement = $connection->prepare($sql)){
        $statement->bind_param("s", $email);

        $email = $_POST['email'];
        $password = $_POST['password'];

        $statement->execute();

        $result = $statement->get_result();
        if ($result->num_rows == 1){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (password_verify($password, $row['password'])){
                session_start();

                $_SESSION['logged'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];

                header("location: ../home.php");
            }else {
                echo "La password non è corretta";
            }
        }else {
            echo "Non esistono account con questa email";
        }
    }else {
        echo "Errore in fase di login";
    }

}

$statement->close();
$connection->close();

?>
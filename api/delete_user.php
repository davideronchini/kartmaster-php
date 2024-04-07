<?php 

require_once('./config.php');

session_start();

$sql = "DELETE FROM users WHERE email = ?";

if($statement = $connection->prepare($sql)){
     $statement->bind_param("s", $email);

    //$email = $_POST['email'];
    $email = $_SESSION['email'];
    
    $statement->execute();
  
    echo "Your account deletion has been successfully processed. We're sorry to see you go! If you have any further questions or concerns, feel free to reach out to us. Thank you for being a part of our community.";
}else {
    echo "There was an issue with deleting your account. Please ensure you have logged in correctly or verify if your account has already been deleted previously.";
    echo "Errore: non è possibile eseguire la query: $sql. " . $connection->error;
}

$statement->close();
$connection->close();

?>

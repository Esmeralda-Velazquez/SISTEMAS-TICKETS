<?php
session_start();
include("dbconnection.php");
if (isset($_POST['lastTicketId'])) {
    $lastTicketId = $_POST['lastTicketId'];

    // Consulta la base de datos para verificar si hay un nuevo ticket
    $query = "SELECT id FROM ticket WHERE id > '$lastTicketId' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo "new_ticket";
    }
    else{
      echo "No-ticket";
    }
}
?>

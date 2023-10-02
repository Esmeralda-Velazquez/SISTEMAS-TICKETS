<?php
session_start();
include("dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $satisfaccion = $_POST["satisfaccion"];
  $comentarios = $_POST["comentarios"];
  $ticket_id = $_SESSION["ticket_id"]; // Asegúrate de tener esta variable en tu sesión

  // Insertar la calificación de satisfacción en la base de datos
  $insert_query = "INSERT INTO satisfaccion (ticket_id, satisfaccion, comentarios) VALUES ('$ticket_id', '$satisfaccion', '$comentarios')";
  mysqli_query($con, $insert_query);
}
// Procesar satisfacción y actualizar la base de datos aquí

// Enviar respuesta al cliente
$response = array('success' => true, 'message' => '¡Gracias por calificar su satisfacción!');
echo json_encode($response);


// Redirigir de vuelta a la página de tickets o a donde sea apropiado
header("Location: tickets.php");
exit();
?>

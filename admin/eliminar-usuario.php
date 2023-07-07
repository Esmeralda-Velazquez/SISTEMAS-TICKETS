<?php
session_start();
require_once 'dbconnection.php';

if (isset($_POST['userid'])) {
  $userid = $_POST['userid'];

  $userid = mysqli_real_escape_string($con, $userid);

  // Realizar la consulta de eliminación
  $query = "DELETE FROM user WHERE id='$userid'";
  $result = mysqli_query($con, $query);

  // Verificar si la consulta se ejecutó correctamente
  if ($result) {
    // Envía una respuesta exitosa al cliente
    echo "Usuario eliminado correctamente.";
  } else {
    // Envía una respuesta de error al cliente
    echo "Error al eliminar el usuario: " . mysqli_error($con);
  }
} else {
  // Si no se recibió el ID del usuario, envía una respuesta de error
  echo "No se recibió el ID del usuario a eliminar.";
}
?>

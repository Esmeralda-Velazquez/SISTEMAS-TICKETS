<?php
include("dbconnection.php");

$idTicketActual = $_GET['id'];


$commentsResult = mysqli_query($con, "SELECT * FROM comments WHERE ticket_id='$idTicketActual'");

$html = '';
while ($commentRow = mysqli_fetch_array($commentsResult)) {
  $html .= "<p><strong>{$commentRow['name_admin']}:</strong> {$commentRow['coment']}</p>";
  $html .= "<p>{$commentRow['commentdate']}</p>";
}

// Devolver la respuesta al llamado AJAX
echo $html;
?>

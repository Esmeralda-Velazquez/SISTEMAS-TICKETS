function checkNewTicket() {
  var lastTicketId = document.getElementById("lastTicketId").value;
  console.log(lastTicketId);
  $.ajax({
    type: "POST",
    url: "check_new_ticket.php",
    data: { lastTicketId: lastTicketId },
    success: function(response) {
      document.body.click();
      console.log(response);
      if (response === "new_ticket") {

        alert("Se ha agregado un nuevo ticket");
        clearInterval(intervalId);
        location.reload();
        // var audio = new Audio('./songs/noti-2.mp3');
        // audio.muted = true;
        // audio.addEventListener('ended', function() {
        //   console.log("Audio playback ended");
        //   setTimeout(function() {
        //     location.reload();
        //   }, 5000);
        // });

        // document.addEventListener('click', function() {
        //   audio.play()
        //   .then(() => {
        //     audio.muted = false;
        //     console.log("Audio played successfully");
        //     alert("Se ha agregado un nuevo ticket");
        //   })
        //   .catch(error => {
        //     console.error("Error playing audio:", error);
        //   });
        // });
      }
      /*else if (response === "No-ticket") {
        // Puedes agregar aquí el código para manejar la respuesta "No-ticket" si es necesario.
      }*/
    }
  });
}

intervalId = setInterval(checkNewTicket, 20000);

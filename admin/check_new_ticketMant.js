
function checkNewTicket() {
    var lastTicketId = document.getElementById("lastTicketId").value;
    console.log(lastTicketId);
    $.ajax({
      type: "POST",
      url: "check_new_ticketMant.php",
      data: { lastTicketId: lastTicketId },
      success: function (response) {
        document.body.click();
        console.log(response);
        if (response === "new_ticket") {
  
          Push.create("NUEVO TICKET MANTENIMIENTO", {
            body: "Se ha creado un nuevo ticket a mantenimiento.",
            icon: "../assets/img/icon-alert.png",
            timeout: 10000,
            onClick: function () {
              window.location.href = "https://tickets.shimaco.online:91/admin/manage-tickets-MANTENIMIENTO.php";
            }
          });
          alert("Se ha agregado un nuevo ticket");
          clearInterval(intervalId);
          location.reload();
        }
      }
    });
  }
  
  intervalId = setInterval(checkNewTicket, 20000);
  
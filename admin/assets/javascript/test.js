function updateClientDetails(clientId) {
  $.ajax({
    url: "clients.php", // Replace with the actual URL that fetches the client details
    method: "GET",
    data: { id: clientId },
    success: function (response) {
      // Extract the details section from the response
      var detailsSection = $(response).find("#clientDetailsTabs").html();
      var billingEditForm = $(response).find("#clientBillingEditForm").html();
      var contactEditForm = $(response).find("#clientContactEditForm").html();

      // Update the content of the details section
      $("#clientDetailsTabs").html(detailsSection);
      $("#clientBillingEditForm").html(billingEditForm);
      $("#clientContactEditForm").html(contactEditForm);
    },
    error: function () {
      console.log("Error occurred while fetching client details");
    },
  });
}

function updateRoomDetails(roomId) {
  $.ajax({
    url: "rooms.php", // Replace with the actual URL that fetches the client details
    method: "GET",
    data: { id: roomId },
    success: function (response) {
      // Extract the details section from the response
      var detailsSection = $(response).find("#clientDetailsTabs").html();
      var billingEditForm = $(response).find("#clientBillingEditForm").html();
      var contactEditForm = $(response).find("#clientContactEditForm").html();
      var photoAddMinForm = $(response).find("#newMinModal").html();
      var photoAddform = $(response).find("#addPhotoModal").html();

      // Update the content of the details section
      $("#clientDetailsTabs").html(detailsSection);
      $("#clientBillingEditForm").html(billingEditForm);
      $("#clientContactEditForm").html(contactEditForm);
      $("#newMinModal").html(photoAddMinForm);
      $("#addPhotoModal").html(photoAddform);
    },
    error: function () {
      console.log("Error occurred while fetching client details");
    },
  });
}

function updateUnvalidatedBookingDetails(bookingId) {
  $.ajax({
    url: "unvalidated-events.php", // Replace with the actual URL that fetches the client details
    method: "GET",
    data: { id: bookingId },
    success: function (response) {
      // Extract the details section from the response
      var detailsSection = $(response).find("#clientDetailsTabs").html();
      var billingEditForm = $(response).find("#clientBillingEditForm").html();
      var contactEditForm = $(response).find("#clientContactEditForm").html();

      // Update the content of the details section
      $("#clientDetailsTabs").html(detailsSection);
      $("#clientBillingEditForm").html(billingEditForm);
      $("#clientContactEditForm").html(contactEditForm);
    },
    error: function () {
      console.log("Error occurred while fetching client details");
    },
  });
}


function updateValidatedBookingDetails(bookingId) {
  $.ajax({
    url: "validated-events.php", // Replace with the actual URL that fetches the client details
    method: "GET",
    data: { id: bookingId },
    success: function (response) {
      // Extract the details section from the response
      var detailsSection = $(response).find("#clientDetailsTabs").html();
      var billingEditForm = $(response).find("#clientBillingEditForm").html();
      var contactEditForm = $(response).find("#clientContactEditForm").html();

      // Update the content of the details section
      $("#clientDetailsTabs").html(detailsSection);
      $("#clientBillingEditForm").html(billingEditForm);
      $("#clientContactEditForm").html(contactEditForm);
    },
    error: function () {
      console.log("Error occurred while fetching client details");
    },
  });
}

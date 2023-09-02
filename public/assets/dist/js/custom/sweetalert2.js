// deleteUser.js
$(document).ready(function () {
  $(".delete-user").on("click", function (e) {
    e.preventDefault();

    let link = $(this).attr("href");
    let userId = $(this).data("user-id");

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: link,
          type: "DELETE",
          data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
          },
          success: function (data) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Deleted",
              text: "The data has been updated successfully!",
              showConfirmButton: true,
              timer: 3000,
            });
          },
          error: function (xhr, status, error) {
            Swal.fire({
              position: "center",
              icon: "error",
              title: "Failed",
              text: error,
              showConfirmButton: true,
              timer: 3000,
            });
          },
        });
      }
    });
  });
});

//////////////////////////////////////
$(function () {
  $(document).on("click", "#delete", function (e) {
    e.preventDefault();

    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });

    let userId = $(this).data("user-id");
    var link = $(this).attr("href");

    Swal.fire({
      title: "Are you sure?",
      text: "Delete This Data?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: "s/user/" + userId,
          type: "DELETE",
          data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
          },
          success: function (data) {
            // The user was deleted successfully
            // Handle success message or UI updates if needed
            console.log("User deleted successfully.");
          },
          error: function (xhr, status, error) {
            // An error occurred while deleting the user
            // Handle error message or UI updates if needed
            console.error("Error deleting user:", error);
          },
        });
      }
    });
  });
});

// deleteUser.js
$(document).on("click", "#delete", function (e) {
  e.preventDefault();
  var link = $(this).attr("href");
  var id = $(this).attr("id");
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this data!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Deleted!", "The data has been deleted.", "success");
      window.location.href = link + "/" + id;
    }
  });
});

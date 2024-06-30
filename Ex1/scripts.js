$(document).ready(function () {
  var checkbox = $('table tbody input[type="checkbox"]');
  $("#selectAll").click(function () {
    if (this.checked) {
      checkbox.each(function () {
        this.checked = true;
      });
    } else {
      checkbox.each(function () {
        this.checked = false;
      });
    }
  });
  checkbox.click(function () {
    if (!this.checked) {
      $("#selectAll").prop("checked", false);
    }
  });

  $(".delete").on("click", function () {
    var id = $(this).data("id");
    $("#delete_id").val(id);
  });

  $(".edit").on("click", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var email = $(this).data("email");
    var address = $(this).data("address");
    var phone = $(this).data("phone");

    $("#edit_id").val(id);
    $("#edit_name").val(name);
    $("#edit_email").val(email);
    $("#edit_address").val(address);
    $("#edit_phone").val(phone);
  });
});

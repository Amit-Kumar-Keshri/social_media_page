jQuery(document).ready(function () {
  jQuery(document).on("click", ".edit-button", function () {
    jQuery(".disabled-box").prop("disabled", false);
    jQuery(".edit-button").hide();
  });
  jQuery(
    'input[name="name"], input[name="email"] , input[name="phone"], input[name="address"], input[name="gender"]'
  ).change(function () {
    jQuery("button[name='update']").removeAttr("disabled");
  });
  jQuery(document).on("click", ".add_friend_btn", function () {
    var people_id = jQuery(this).attr("data-id");
    console.log(people_id);
    jQuery.ajax({
      url: "http://localhost/social_media_page/response-data.php",
      type: "POST",
      cache: false,
      dataType: "JSON",
      data: {
        action: "add_friend_action",
        people_id: people_id,
      },
      success: function (response) {
        console.log(response);
      },
      error: function (xhr, status, error) {
        //var err = eval("(" + xhr.responseText + ")");
        console.log(error);
      },
    });
  });
  
  jQuery(document).on("click", ".imgUploadBtn", function () {
    var user_id = jQuery(this).attr("data-id");
    var name = jQuery(this).attr("name");

    console.log(user_id);
    jQuery.ajax({
      url: "http://localhost/social_media_page/response-data.php",
      type: "POST",
      cache: false,
      dataType: "JSON",
      data: {
        action: "upload_image_action",
        user_id: user_id,
        name: name
      },
      success: function (response) {
        console.log(response);
      },
      error: function (xhr, status, error) {
        //var err = eval("(" + xhr.responseText + ")");
        console.log(error);
      },
    });
  });
});

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
  
  jQuery(document).on("change", ".imgUploadBtn", function () {
    var user_id = jQuery(this).attr("data-id");
    var image_file = jQuery(".imgUploadBtn")[0].files;
    console.log(image_file);
   var formdata =  new FormData();
    formdata.append('action', 'upload_image_action');
    formdata.append('user_id', user_id);
    formdata.append('image_file', image_file[0]);

    console.log(formdata);
    console.log(image_file[0]);
    jQuery.ajax({
      url: "http://localhost/social_media_page/response-data.php",
      type: "POST",
      cache: false,
      dataType: "JSON",
      data: formdata,
      contentType: false,    
      processData: false,
      success: function (response) {
        console.log(response);
        jQuery(".profile-image, .header-profile-image").attr("src", response.image);
      },
      error: function (xhr, status, error) {
        //var err = eval("(" + xhr.responseText + ")");
        console.log(error);
      },
    });
  });
});

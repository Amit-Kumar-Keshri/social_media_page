jQuery(document).ready(function(){
    jQuery(document).on('click','.edit-button', function() {
        jQuery('.disabled-box').prop("disabled",false);
        jQuery('.edit-button').hide();
});




jQuery('input[name="name"], input[name="email"] , input[name="phone"], input[name="address"], input[name="gender"]').change(function(){
   
      jQuery("button[name='update']").removeAttr('disabled');
   
  });
});
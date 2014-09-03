<?php /*  Template Name: add images with uploader*/
?>
 <?php get_header(); ?>
<form id="thumbnail_upload" method="post" action="#" enctype="multipart/form-data">
  <input type="file" name="thumbnail" id="thumbnail">
  <?php $nonce= wp_create_nonce  ('upload_thumb'); ?>
  <input type="hidden" name="post_id" id="post_id" value="1">
  <input type="hidden" name="action" id="action" value="my_upload_action">
  <input id="submit-ajax" name="submit-ajax" type="submit" value="upload">
<form>
<div id="output1"></div>
<script>
$(document).ready(function() { 
    var options = { 
        target:        '#output1',      // target element(s) to be updated with server response 
        _ajax_nonce:   '<?php echo $nonce ?>',
        beforeSubmit:  showRequest,     // pre-submit callback 
        success:       showResponse,    // post-submit callback 
        url:    ajaxurl                 // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php     
    }; 

    // bind form using 'ajaxForm' 
    $('#thumbnail_upload').ajaxForm(options); 
});
function showRequest(formData, jqForm, options) {
//do extra stuff before submit like disable the submit button
$('#output1').html('Sending...');
$('#submit-ajax').attr("disabled", "disabled");
}
function showResponse(responseText, statusText, xhr, $form)  {
//do extra stuff after submit
$('#output1').html('envoyé...');
}
</script>

<?php get_footer(); ?>
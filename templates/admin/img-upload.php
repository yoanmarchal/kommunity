<?php

/*

// include js
add_action('admin_enqueue_scripts', function($page){

  // check if this your page here with the upload form!
  if(($page !== 'post.php') || (get_post_type() !== 'post'))
    return;

  wp_enqueue_script('plupload-all');
});



// this adds a simple metabox with the upload form on the edit-post page
add_action('add_meta_boxes', function(){
  add_meta_box('gallery_photos', __('Photos'), 'upload_meta_box', 'photo', 'normal', 'high');

});                                               



// so here's the actual uploader
// most of the code comes from media.php and handlers.js
function upload_meta_box(){ ?>
   <div id="plupload-upload-ui" class="hide-if-no-js">
     <div id="drag-drop-area">
       <div class="drag-drop-inside">
        <p class="drag-drop-info"><?php _e('Drop files here'); ?></p>
        <p><?php _ex('or', 'Uploader: Drop files here - or - Select Files'); ?></p>
        <p class="drag-drop-buttons"><input id="plupload-browse-button" type="button" value="<?php esc_attr_e('Select Files'); ?>" class="button" /></p>
      </div>
     </div>
  </div>

  <?php

  $plupload_init = array(
    'runtimes'            => 'html5,silverlight,flash,html4',
    'browse_button'       => 'plupload-browse-button',
    'container'           => 'plupload-upload-ui',
    'drop_element'        => 'drag-drop-area',
    'file_data_name'      => 'async-upload',            
    'multiple_queues'     => true,
    'max_file_size'       => wp_max_upload_size().'b',
    'url'                 => admin_url('admin-ajax.php'),
    'flash_swf_url'       => includes_url('js/plupload/plupload.flash.swf'),
    'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
    'filters'             => array(array('title' => __('Allowed Files'), 'extensions' => '*')),
    'multipart'           => true,
    'urlstream_upload'    => true,

    // additional post data to send to our ajax hook
    'multipart_params'    => array(
      '_ajax_nonce' => wp_create_nonce('photo-upload'),
      'action'      => 'photo_gallery_upload',            // the ajax action name
    ),
  );

  // we should probably not apply this filter, plugins may expect wp's media uploader...
  $plupload_init = apply_filters('plupload_init', $plupload_init); ?>

  <script type="text/javascript">

    jQuery(document).ready(function($){

      // create the uploader and pass the config from above
      var uploader = new plupload.Uploader(<?php echo json_encode($plupload_init); ?>);

      // checks if browser supports drag and drop upload, makes some css adjustments if necessary
      uploader.bind('Init', function(up){
        var uploaddiv = $('#plupload-upload-ui');

        if(up.features.dragdrop){
          uploaddiv.addClass('drag-drop');
            $('#drag-drop-area')
              .bind('dragover.wp-uploader', function(){ uploaddiv.addClass('drag-over'); })
              .bind('dragleave.wp-uploader, drop.wp-uploader', function(){ uploaddiv.removeClass('drag-over'); });

        }else{
          uploaddiv.removeClass('drag-drop');
          $('#drag-drop-area').unbind('.wp-uploader');
        }
      });

      uploader.init();

      // a file was added in the queue
      uploader.bind('FilesAdded', function(up, files){
        var hundredmb = 100 * 1024 * 1024, max = parseInt(up.settings.max_file_size, 10);

        plupload.each(files, function(file){
          if (max > hundredmb && file.size > hundredmb && up.runtime != 'html5'){
            // file size error?

          }else{

            // a file was added, you may want to update your DOM here...
            console.log(file);
          }
        });

        up.refresh();
        up.start();
      });

      // a file was uploaded 
      uploader.bind('FileUploaded', function(up, file, response) {

        // this is your ajax response, update the DOM with it or something...
        console.log(response);

      });

    });   

  </script>
  <?php
}


// handle uploaded file here
add_action('wp_ajax_photo_gallery_upload', function(){

  check_ajax_referer('photo-upload');

  // you can use WP's wp_handle_upload() function:
  $file = $_FILES['async-upload'];
  $status = wp_handle_upload($file, array('test_form'=>true, 'action' => 'photo_gallery_upload'));

  // and output the results or something...
  echo 'Uploaded to: '.$status['url'];

  //Adds file as attachment to WordPress
  echo "\n Attachment ID: " .wp_insert_attachment( array(
     'post_mime_type' => $status['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($file['name'])),
     'post_content' => '',
     'post_status' => 'inherit'
  ), $status['file']);

  exit;
});


*/

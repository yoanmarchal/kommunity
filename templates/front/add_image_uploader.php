<?php 

/* 
 ref : http://www.krishnakantsharma.com/2012/01/image-uploads-on-wordpress-admin-screens-using-jquery-and-new-plupload/




function plu_admin_enqueue() { //ajout des scripts et css
    wp_enqueue_script('plupload-all');
 
    wp_register_script('myplupload', 'http://176.31.106.150/~devellop/wp-content/themes/pub4you-tlp/js/Myplupload.js');
    wp_enqueue_script('myplupload',false,'',true );

    wp_register_script('ajaxupload', 'http://176.31.106.150/~devellop/wp-content/themes/pub4you-tlp/js/ajaxupload.3.5.js');
    wp_enqueue_script('ajaxupload',false,'',true );

}
add_action( 'wp_footer', 'plu_admin_enqueue' );


function plupload_footer() { //fichier de configurations
// place js config array for plupload
    $plupload_init = array(
        'runtimes' => 'html5,silverlight,flash,html4',
        'browse_button' => 'plupload-browse-button', // will be adjusted per uploader
        'container' => 'plupload-upload-ui', // will be adjusted per uploader
        'drop_element' => 'drag-drop-area', // will be adjusted per uploader
        'file_data_name' => 'async-upload', // will be adjusted per uploader
        'multiple_queues' => true,
        'max_file_size' => '1mb',
        'url' => admin_url('admin-ajax.php'),
        'flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'),
        'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
        'filters' => array(array('title' => __('Allowed Files'), 'extensions' => '*')),
        'multipart' => true,
        'urlstream_upload' => true,
        'multi_selection' => false, // will be added per uploader
         // additional post data to send to our ajax hook
        'multipart_params' => array(
            '_ajax_nonce' => "", // will be added per uploader
            'action' => 'plupload_action', // the ajax action name
            'imgid' => 0 // will be added per uploader
        )
    );
?>
<script type="text/javascript">
    var base_plupload_config=<?php echo json_encode($plupload_init); ?>;
</script>

<?php
}
add_action("wp_footer", "plupload_footer");


function g_plupload_action() {
 
    // check ajax noonce
    $imgid = $_POST["imgid"];
    check_ajax_referer($imgid . 'pluploadan');
 
    // handle file upload
    $status = wp_handle_upload($_FILES[$imgid . 'async-upload'], array('test_form' => true, 'action' => 'plupload_action'));
 
    // send the uploaded file url in response
    echo $status['url'];
    exit;
}
add_action('wp_ajax_plupload_action', 'g_plupload_action');

*/


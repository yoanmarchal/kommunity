<?php
// configure this as per your WP install folder structure
// it loads WP so its functions can be used
				require_once("../../../../wp-config.php");
				$wp->init();
				$wp->parse_request();
				$wp->query_posts();
				$wp->register_globals();
				$wp->send_headers();

//determine the upload path of WP
$uploads = wp_upload_dir();
$sub_dir = ( $uploads['subdir'] );
$upload_dir = '../../../uploads'.$sub_dir.'/';

//get the uploaded file
$file = $upload_dir .'snp_'.time().'_'.basename($_FILES['uploadfile']['name']); 
//get the uploaded file size
$size = $_FILES['uploadfile']['size'];

//build a response array to use with JSON output
$response = array();

/* if it can store it and file size is under 512KB, give the green light and 
return its path. Here you can adjust the maximum allowed file size
*/
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file) && ($size<512000)) { 
  $response = array(
      "ok" => "ok",
	  "file" => time().'_'.basename($_FILES['uploadfile']['name']),
  );
  
//if file is over 512KB, return a response so we know it's too big
} elseif ($size>512000){
  $response = array(
      "ok" => "toobig",
  );
  //and delete it from the server, to free space
  unlink($file);
}
// if the file size is valid but there was an error and it can't store it, let us know
elseif (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file) && ($size<512000)) {
  $response = array(
      "ok" => "error",
  );
}
//echo the JSON response
echo json_encode($response);

?>
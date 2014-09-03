<?php
/*  recuperation du nombre de fan facebook   */
/////bug de temps en temps
/*
function fb_count(){
         $fb_id = '111558088936471';
         $count = get_transient('fb5_count');
    if ($count !== false) return $count;
         $count = 0;
         $data = wp_remote_get('http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id='.$fb_id.'');
   if (is_wp_error($data)) {
         return 'Error!!';
   }else{
        $countOrig = strip_tags($data[body]);
	$count = preg_replace('/\s+/','',$countOrig); // strip whitespace
   }
set_transient('fb5_count', $count, 60*60*24); // 24 hour cache
return $count;
}
*/

/* recuperation du nombre de google + */
/*
function gplus_count(){
         $count = get_transient('gplus_count');
    if ($count !== false) return $count;
         $count = 0;
        $data = file_get_contents('http://widgetsplus.com/google_plus_widget.php?pid=112081266351587925988&host=soyez-connus.com');

   if (is_wp_error($data)) {
         return 'whoa error!!!';
   }else{

        $match = preg_match('/<strong>(.*?)<\/strong>/s', $data, $results);

        if ( isset ( $results ) && !empty ( $results ) )
                {
                        $count = $results[1];
                }
        }
set_transient('gplus_count', $count, 60*60*24); // 72 hour cache
return $count;
}
*/

/*
function facebook_count(){
$page_id = "111558088936471";
$xml = @simplexml_load_file("http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id=".$page_id."") or die ("a lot");
$fans = $xml->page->fan_count;
echo $fans;
}
*/
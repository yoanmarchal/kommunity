<?php

//date heure bonplan sortie
add_action('add_meta_boxes', 'init_metabox_date_heure');
function init_metabox_date_heure()
{
    add_meta_box('date_bonplan_sortie', 'Date et heure du bonplan', 'date_heure_bp', 'bonplan', 'side');
}

function date_heure_bp($post)
{
    $debut_date = get_post_meta($post->ID, '_debut_date', true);
    $debut_heure = get_post_meta($post->ID, '_debut_heure', true);
    $fin_date = get_post_meta($post->ID, '_fin_date', true);
    $fin_heure = get_post_meta($post->ID, '_fin_heure', true);
    ?>
  <label>A partir du</label><br>
  <input type="datetime" name="deb_dat" id="deb_dat" class="mydatepicker" placeholder="01/12/2012" value="<?php echo $debut_date;
    ?>" style="width:100px;" />
  <input type="text" name="deb_heure" id="" placeholder="08:00" value="<?php echo $debut_heure;
    ?>" />
  <label>Jusqu'au </label><br>
  <input type="datetime" name="fin_dat" id="fin_dat" class="mydatepicker" placeholder="02/12/2012" value="<?php echo $fin_date;
    ?>" style="width:100px;"/>
  <input type="text" name="fin_heure" id="" placeholder="18:00" value="<?php echo $fin_heure;
    ?>" /><br />
  
<?php

}

add_action('save_post', 'save_metabox_date_heure');
function save_metabox_date_heure($post_id)
{
    if (isset($_POST['deb_dat'])) {
        update_post_meta($post_id, '_debut_date', sanitize_text_field($_POST['deb_dat']));
    }
    if (isset($_POST['deb_heure'])) {
        update_post_meta($post_id, '_debut_heure', sanitize_text_field($_POST['deb_heure']));
    }
    if (isset($_POST['fin_dat'])) {
        update_post_meta($post_id, '_fin_date', sanitize_text_field($_POST['fin_dat']));
    }
    if (isset($_POST['fin_heure'])) {
        update_post_meta($post_id, '_fin_heure', sanitize_text_field($_POST['fin_heure']));
    }
}

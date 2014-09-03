<?php

//adresse -> adherents + adresse -> bon plan sortie ok    

add_action('add_meta_boxes','init_metabox_adresse');
function init_metabox_adresse(){
    add_meta_box('metabox_adresse', 'adresse du bon plan', 'metabox_adresse_fonct', 'bonplan', 'side', 'high');
}

function metabox_adresse_fonct($post){
  $rue     		 = get_post_meta($post->ID,'_rue',true);
  $codepostal  	 = get_post_meta($post->ID,'_code_postal',true);
  $ville 		 = get_post_meta($post->ID,'_ville',true);
  $region 		 = get_post_meta($post->ID,'_region',true);
  ?>
  <textarea type="text" name="rue" id="" placeholder="275, rue de toulouse" style="width:256px;" /><?php echo $rue; ?></textarea><br />
  <input type="number" name="codepostal" id="" placeholder="87000" value="<?php echo $codepostal; ?>" /><br />
  <input type="text" name="ville" id="" placeholder="limoges" value="<?php echo $ville; ?>" /><br />
<?php

   echo '<label for="region_selection">Indiquez votre région :</label>';
    echo '<select id="region_selection" name="region_selection">';
		echo '<option value="alsace" '.selected($region, 'alsace').'>Alsace</option>';
        echo '<option value="aquitaine" '.selected($region, 'aquitaine').'>Aquitaine</option>';
		echo '<option value="auvergne" '.selected($region, 'auvergne').'>Auvergne</option>';
		echo '<option value="bourgogne" '.selected($region, 'bourgogne').'>Bourgogne</option>';
		echo '<option value="bretagne" '.selected($region, 'bretagne').'>Bretagne</option>';
		echo '<option value="centre" '.selected($region, 'centre').'>Centre</option>';
		echo '<option value="champagne-ardenne" '.selected($region, 'champagne-ardenne').'>Champagne-Ardenne</option>';
		echo '<option value="corse" '.selected($region, 'corse').'>Corse</option>';
		echo '<option value="franche-comte" '.selected($region, 'franche-comte').'>Franche-Comté</option>';
		echo '<option value="guadeloupe" '.selected($region, 'guadeloupe').'>Guadeloupe</option>';
		echo '<option value="guyane" '.selected($region, 'guyane').'>Guyane</option>';
		echo '<option value="ile-de-france" '.selected($region, 'ile-de-france').'>Île-de-France</option>';
		echo '<option value="languedoc-roussillon" '.selected($region, 'languedoc-roussillon').'>Languedoc-Roussillon</option>';
		echo '<option value="limousin" '.selected($region, 'limousin').'>Limousin</option>';
		echo '<option value="lorraine" '.selected($region, 'lorraine').'>Lorraine</option>';
		echo '<option value="martinique" '.selected($region, 'martinique').'>Martinique</option>';
		echo '<option value="mayotte" '.selected($region, 'mayotte').'>Mayotte</option>';
		echo '<option value="midi-Pyrenees" '.selected($region, 'midi-Pyrenees').'>Midi Pyrénées</option>';
		echo '<option value="nord-pas-de-calais" '.selected($region, 'nord-pas-de-calais').'>Nord-Pas-de-Calais</option>';
		echo '<option value="basse-normandie" '.selected($region, 'basse-normandie').'>Basse-Normandie</option>';
		echo '<option value="haute-normandie" '.selected($region, 'haute-normandie').'>Haute-Normandie</option>';
		echo '<option value="pays-de-la-loire" '.selected($region, 'pays-de-la-loire').'>Pays de la Loire</option>';
		echo '<option value="picardie" '.selected($region, 'picardie').'>Picardie</option>';
		echo '<option value="poitou-charentes" '.selected($region, 'poitou-charentes').'>Poitou-Charentes</option>';
		echo '<option value="provence-alpes-cote-d-azur" '.selected($region, 'provence-alpes-cote-d-azur').'>Provence-Alpes-Côte d\'Azur</option>';
		echo '<option value="la-reunion" '.selected($region, 'la-reunion').'>La Réunion</option>';
		echo '<option value="rhone-alpes" '.selected($region, 'rhone-alpes').'>Rhône-Alpes</option>';
    echo '</select>';


}

add_action('save_post','save_metabox_adresse');
function save_metabox_adresse($post_id){
  if(isset($_POST['rue'])){
    update_post_meta($post_id, '_rue', esc_textarea($_POST['rue']));
  }
  if(isset($_POST['codepostal'])){
    update_post_meta($post_id, '_code_postal', sanitize_text_field($_POST['codepostal']));
  }
  if(isset($_POST['ville'])){
    update_post_meta($post_id, '_ville', sanitize_text_field($_POST['ville']));
  }
  if(isset($_POST['region_selection']))
        update_post_meta($post_id, '_region', esc_html($_POST['region_selection']));
}




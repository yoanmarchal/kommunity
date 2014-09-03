<?php


//horaires societe aherents    ok
add_action('add_meta_boxes','init_metabox_horaires');
function init_metabox_horaires(){
    add_meta_box('horaires_adherent', 'horaires ouverture', 'horaire_ad_func', 'adherents', 'normal', 'high');
}

function horaire_ad_func($post){

//lundi
  $lmo   = get_post_meta($post->ID,'_lundi_matin_ouverture',true);
  $lmf   = get_post_meta($post->ID,'_lundi_matin_fermeture',true);
  
  $lao   = get_post_meta($post->ID,'_lundi_aprem_ouverture',true);
  $laf   = get_post_meta($post->ID,'_lundi_aprem_fermeture',true);
  
//mardi  
  
  $mmo = get_post_meta($post->ID,'_mardi_matin_ouverture',true);
  $mmf  = get_post_meta($post->ID,'_mardi_matin_fermeture',true);
  
  $mao = get_post_meta($post->ID,'_mardi_aprem_ouverture',true);
  $maf  = get_post_meta($post->ID,'_mardi_aprem_fermeture',true);
  
//mercredi  
  
  $mermo     = get_post_meta($post->ID,'_mercredi_matin_ouverture',true);
  $mermf      = get_post_meta($post->ID,'_mercredi_matin_fermeture',true);
  
  $merao     = get_post_meta($post->ID,'_mercredi_aprem_ouverture',true);
  $meraf      = get_post_meta($post->ID,'_mercredi_aprem_fermeture',true);
  
//jeudi  

  $jmo     = get_post_meta($post->ID,'_jeudi_matin_ouverture',true);
  $jmf      = get_post_meta($post->ID,'_jeudi_matin_fermeture',true);
  
  $jao     = get_post_meta($post->ID,'_jeudi_aprem_ouverture',true);
  $jaf      = get_post_meta($post->ID,'_jeudi_aprem_fermeture',true);
  
  
  
 // vendredi

  $vmo     = get_post_meta($post->ID,'_vendredi_matin_ouverture',true);
  $vmf      = get_post_meta($post->ID,'_vendredi_matin_fermeture',true);
  
  $vao     = get_post_meta($post->ID,'_vendredi_aprem_ouverture',true);
  $vaf      = get_post_meta($post->ID,'_vendredi_aprem_fermeture',true);
  
  
  // samedi
  
  $smo     = get_post_meta($post->ID,'_samedi_matin_ouverture',true);
  $smf      = get_post_meta($post->ID,'_samedi_matin_fermeture',true);
  
  $sao     = get_post_meta($post->ID,'_samedi_aprem_ouverture',true);
  $saf      = get_post_meta($post->ID,'_samedi_aprem_fermeture',true);
  
  
  
  // dimanche
  
  $dmo     = get_post_meta($post->ID,'_dimanche_matin_ouverture',true);
  $dmf      = get_post_meta($post->ID,'_dimanche_matin_fermeture',true);
  
  $dao     = get_post_meta($post->ID,'_dimanche_aprem_ouverture',true);
  $daf      = get_post_meta($post->ID,'_dimanche_aprem_fermeture',true);


  ?>
  <!--lundi-->
  <label class="h-ind">Lundi</label>
  <input type="text" name="lundi_matin_ouverture" id="lundi_matin_ouverture" placeholder="08:00" value="<?php echo $lmo; ?>" style="width:50px;" />
  <input type="text" name="lundi_matin_fermeture" id="lundi_matin_fermeture" placeholder="12:00" value="<?php echo $lmf; ?>" style="width:50px;" />
  
  <input type="text" name="lundi_aprem_ouverture" id="lundi_aprem_ouverture" placeholder="14:00" value="<?php echo $lao; ?>" style="width:50px;" />
  <input type="text" name="lundi_aprem_fermeture" id="lundi_aprem_fermeture" placeholder="18:00" value="<?php echo $laf; ?>" style="width:50px;" /><br>
  
  
  <!--mardi-->
  <label class="h-ind">Mardi</label>
  <input type="text" name="mardi_matin_ouverture" id="mardi_matin_ouverture" placeholder="08:00" value="<?php echo $mmo; ?>" style="width:50px;" />
  <input type="text" name="mardi_matin_fermeture" id="mardi_matin_fermeture" placeholder="12:00" value="<?php echo $mmf; ?>" style="width:50px;" />
  
  <input type="text" name="mardi_aprem_ouverture" id="mardi_aprem_ouverture" placeholder="14:00" value="<?php echo $mao; ?>" style="width:50px;" />
  <input type="text" name="mardi_aprem_fermeture" id="mardi_aprem_fermeture" placeholder="18:00" value="<?php echo $maf; ?>" style="width:50px;" /><br>
  
  <!--mercredi-->
  <label class="h-ind">Mercredi</label>
  <input type="text" name="mercredi_matin_ouverture" id="mercredi_matin_ouverture" placeholder="08:00" value="<?php echo $mermo; ?>" style="width:50px;" />
  <input type="text" name="mercredi_matin_fermeture" id="mercredi_matin_fermeture" placeholder="12:00" value="<?php echo $mermf; ?>" style="width:50px;" />
  
  <input type="text" name="mercredi_aprem_ouverture" id="mercredi_aprem_ouverture" placeholder="14:00" value="<?php echo $merao; ?>" style="width:50px;" />
  <input type="text" name="mercredi_aprem_fermeture" id="mercredi_aprem_fermeture" placeholder="18:00" value="<?php echo $meraf; ?>" style="width:50px;" /><br>
  
  <!--jeudi-->
  <label class="h-ind">Jeudi</label>
  <input type="text" name="jeudi_matin_ouverture" id="jeudi_matin_ouverture" placeholder="08:00" value="<?php echo $jmo; ?>" style="width:50px;" />
  <input type="text" name="jeudi_matin_fermeture" id="jeudi_matin_fermeture" placeholder="12:00" value="<?php echo $jmf; ?>" style="width:50px;" />
  
  <input type="text" name="jeudi_aprem_ouverture" id="jeudi_aprem_ouverture" placeholder="14:00" value="<?php echo $jao; ?>" style="width:50px;" />
  <input type="text" name="jeudi_aprem_fermeture" id="jeudi_aprem_fermeture" placeholder="18:00" value="<?php echo $jaf; ?>" style="width:50px;" /><br>
  
  <!--vendredi-->
  <label class="h-ind">Vendredi</label>
  <input type="text" name="vendredi_matin_ouverture" id="vendredi_matin_ouverture" placeholder="08:00" value="<?php echo $vmo; ?>" style="width:50px;" />
  <input type="text" name="vendredi_matin_fermeture" id="vendredi_matin_fermeture" placeholder="12:00" value="<?php echo $vmf; ?>" style="width:50px;" />
  
  <input type="text" name="vendredi_aprem_ouverture" id="vendredi_aprem_ouverture" placeholder="14:00" value="<?php echo $vao; ?>" style="width:50px;" />
  <input type="text" name="vendredi_aprem_fermeture" id="vendredi_aprem_fermeture" placeholder="18:00" value="<?php echo $vaf; ?>" style="width:50px;" /><br>
  
   <!--samedi-->
  <label class="h-ind">Samedi</label>
  <input type="text" name="samedi_matin_ouverture" id="samedi_matin_ouverture" placeholder="08:00" value="<?php echo $smo; ?>" style="width:50px;" />
  <input type="text" name="samedi_matin_fermeture" id="samedi_matin_fermeture" placeholder="12:00" value="<?php echo $smf; ?>" style="width:50px;" />
  
  <input type="text" name="samedi_aprem_ouverture" id="samedi_aprem_ouverture" placeholder="14:00" value="<?php echo $sao; ?>" style="width:50px;" />
  <input type="text" name="samedi_aprem_fermeture" id="samedi_aprem_fermeture" placeholder="18:00" value="<?php echo $saf; ?>" style="width:50px;" /><br>
  
   <!--dimanche-->
  <label class="h-ind">Dimanche</label>
  <input type="text" name="dimanche_matin_ouverture" id="dimanche_matin_ouverture" placeholder="08:00" value="<?php echo $dmo; ?>" style="width:50px;" />
  <input type="text" name="dimanche_matin_fermeture" id="dimanche_matin_fermeture" placeholder="12:00" value="<?php echo $dmf; ?>" style="width:50px;" />
  
  <input type="text" name="dimanche_aprem_ouverture" id="dimanche_aprem_ouverture" placeholder="14:00" value="<?php echo $dao; ?>" style="width:50px;" />
  <input type="text" name="dimanche_aprem_fermeture" id="dimanche_aprem_fermeture" placeholder="18:00" value="<?php echo $daf; ?>" style="width:50px;" /><br>

<?php
}

add_action('save_post','save_metabox_horaire');
function save_metabox_horaire($post_id){
  /* lundi */
  if(isset($_POST['lundi_matin_ouverture'])){
    update_post_meta($post_id, '_lundi_matin_ouverture', sanitize_text_field($_POST['lundi_matin_ouverture']));
  }
  if(isset($_POST['lundi_matin_fermeture'])){
    update_post_meta($post_id, '_lundi_matin_fermeture', sanitize_text_field($_POST['lundi_matin_fermeture']));
  }
  
  
  if(isset($_POST['lundi_aprem_ouverture'])){
    update_post_meta($post_id, '_lundi_aprem_ouverture', sanitize_text_field($_POST['lundi_aprem_ouverture']));
  }
  if(isset($_POST['lundi_aprem_fermeture'])){
    update_post_meta($post_id, '_lundi_aprem_fermeture', sanitize_text_field($_POST['lundi_aprem_fermeture']));
  }
  
  
  
  
   /* mardi */
  if(isset($_POST['mardi_matin_ouverture'])){
    update_post_meta($post_id, '_mardi_matin_ouverture', sanitize_text_field($_POST['mardi_matin_ouverture']));
  }
  if(isset($_POST['mardi_matin_fermeture'])){
    update_post_meta($post_id, '_mardi_matin_fermeture', sanitize_text_field($_POST['mardi_matin_fermeture']));
  }
  
  
  if(isset($_POST['mardi_aprem_ouverture'])){
    update_post_meta($post_id, '_mardi_aprem_ouverture', sanitize_text_field($_POST['mardi_aprem_ouverture']));
  }
  if(isset($_POST['mardi_aprem_fermeture'])){
    update_post_meta($post_id, '_mardi_aprem_fermeture', sanitize_text_field($_POST['mardi_aprem_fermeture']));
  }
  
  
  /* mercredi */
  if(isset($_POST['mercredi_matin_ouverture'])){
    update_post_meta($post_id, '_mercredi_matin_ouverture', sanitize_text_field($_POST['mercredi_matin_ouverture']));
  }
  if(isset($_POST['mercredi_matin_fermeture'])){
    update_post_meta($post_id, '_mercredi_matin_fermeture', sanitize_text_field($_POST['mercredi_matin_fermeture']));
  }
  
  
  if(isset($_POST['mercredi_aprem_ouverture'])){
    update_post_meta($post_id, '_mercredi_aprem_ouverture', sanitize_text_field($_POST['mercredi_aprem_ouverture']));
  }
  if(isset($_POST['mercredi_aprem_fermeture'])){
    update_post_meta($post_id, '_mercredi_aprem_fermeture', sanitize_text_field($_POST['mercredi_aprem_fermeture']));
  }
  
  
  
    /* jeudi */
  if(isset($_POST['jeudi_matin_ouverture'])){
    update_post_meta($post_id, '_jeudi_matin_ouverture', sanitize_text_field($_POST['jeudi_matin_ouverture']));
  }
  if(isset($_POST['jeudi_matin_fermeture'])){
    update_post_meta($post_id, '_jeudi_matin_fermeture', sanitize_text_field($_POST['jeudi_matin_fermeture']));
  }
  
  
  if(isset($_POST['jeudi_aprem_ouverture'])){
    update_post_meta($post_id, '_jeudi_aprem_ouverture', sanitize_text_field($_POST['jeudi_aprem_ouverture']));
  }
  if(isset($_POST['lundi_aprem_fermeture'])){
    update_post_meta($post_id, '_jeudi_aprem_fermeture', sanitize_text_field($_POST['jeudi_aprem_fermeture']));
  }
  
  
  
    /* vendredi */
  if(isset($_POST['vendredi_matin_ouverture'])){
    update_post_meta($post_id, '_vendredi_matin_ouverture', sanitize_text_field($_POST['vendredi_matin_ouverture']));
  }
  if(isset($_POST['vendredi_matin_fermeture'])){
    update_post_meta($post_id, '_vendredi_matin_fermeture', sanitize_text_field($_POST['vendredi_matin_fermeture']));
  }
  
  
  if(isset($_POST['vendredi_aprem_ouverture'])){
    update_post_meta($post_id, '_vendredi_aprem_ouverture', sanitize_text_field($_POST['vendredi_aprem_ouverture']));
  }
  if(isset($_POST['vendredi_aprem_fermeture'])){
    update_post_meta($post_id, '_vendredi_aprem_fermeture', sanitize_text_field($_POST['vendredi_aprem_fermeture']));
  }
  
    /* samedi */
  if(isset($_POST['samedi_matin_ouverture'])){
    update_post_meta($post_id, '_samedi_matin_ouverture', sanitize_text_field($_POST['samedi_matin_ouverture']));
  }
  if(isset($_POST['samedi_matin_fermeture'])){
    update_post_meta($post_id, '_samedi_matin_fermeture', sanitize_text_field($_POST['samedi_matin_fermeture']));
  }
  
  
  if(isset($_POST['samedi_aprem_ouverture'])){
    update_post_meta($post_id, '_samedi_aprem_ouverture', sanitize_text_field($_POST['samedi_aprem_ouverture']));
  }
  if(isset($_POST['samedi_aprem_fermeture'])){
    update_post_meta($post_id, '_samedi_aprem_fermeture', sanitize_text_field($_POST['samedi_aprem_fermeture']));
  }
  
  
   /* dimanche */
  if(isset($_POST['dimanche_matin_ouverture'])){
    update_post_meta($post_id, '_dimanche_matin_ouverture', sanitize_text_field($_POST['dimanche_matin_ouverture']));
  }
  if(isset($_POST['dimanche_matin_fermeture'])){
    update_post_meta($post_id, '_dimanche_matin_fermeture', sanitize_text_field($_POST['dimanche_matin_fermeture']));
  }
  
  
  if(isset($_POST['dimanche_aprem_ouverture'])){
    update_post_meta($post_id, '_dimanche_aprem_ouverture', sanitize_text_field($_POST['dimanche_aprem_ouverture']));
  }
  if(isset($_POST['dimanche_aprem_fermeture'])){
    update_post_meta($post_id, '_dimanche_aprem_fermeture', sanitize_text_field($_POST['dimanche_aprem_fermeture']));
  }
 

}

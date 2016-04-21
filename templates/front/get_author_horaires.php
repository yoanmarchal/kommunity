<?php

function get_author_horaires($curauth)
{
    if (/* verification des varibles et de leur presence  */
        // lundi
        get_the_author_meta('lundi_matin_ouverture', $curauth->ID) || get_the_author_meta('lundi_matin_fermeture', $curauth->ID)  || get_the_author_meta('lundi_aprem_ouverture', $curauth->ID) || get_the_author_meta('lundi_aprem_fermeture', $curauth->ID)

        // mardi
        || get_the_author_meta('mardi_matin_ouverture', $curauth->ID) || get_the_author_meta('mardi_matin_fermeture', $curauth->ID) || get_the_author_meta('mardi_aprem_ouverture', $curauth->ID) || get_the_author_meta('mardi_aprem_fermeture', $curauth->ID)

        // mercredi
        || get_the_author_meta('mercredi_matin_ouverture', $curauth->ID) || get_the_author_meta('mercredi_matin_fermeture', $curauth->ID) || get_the_author_meta('mercredi_aprem_ouverture', $curauth->ID) || get_the_author_meta('mercredi_aprem_fermeture', $curauth->ID)

        //jeudi
        || get_the_author_meta('jeudi_matin_ouverture', $curauth->ID) || get_the_author_meta('jeudi_matin_fermeture', $curauth->ID) || get_the_author_meta('jeudi_aprem_ouverture', $curauth->ID) || get_the_author_meta('jeudi_aprem_fermeture', $curauth->ID)

        //vendredi
        || get_the_author_meta('vendredi_matin_ouverture', $curauth->ID) || get_the_author_meta('vendredi_matin_fermeture', $curauth->ID) || get_the_author_meta('vendredi_aprem_ouverture', $curauth->ID) || get_the_author_meta('vendredi_aprem_fermeture', $curauth->ID)

        //samedi
        || get_the_author_meta('samedi_matin_ouverture', $curauth->ID) || get_the_author_meta('samedi_matin_fermeture', $curauth->ID) || get_the_author_meta('samedi_aprem_ouverture', $curauth->ID) || get_the_author_meta('samedi_aprem_fermeture', $curauth->ID)

        //dimanche
        || get_the_author_meta('dimanche_matin_ouverture', $curauth->ID) || get_the_author_meta('dimanche_matin_fermeture', $curauth->ID) || get_the_author_meta('dimanche_aprem_ouverture', $curauth->ID) || get_the_author_meta('dimanche_aprem_fermeture', $curauth->ID)
    ):

 ?>
<h2>Horaires</h2>	
<ul class="list-product">
	
	<?php if (get_the_author_meta('lundi_matin_ouverture', $curauth->ID) || get_the_author_meta('lundi_matin_fermeture', $curauth->ID)  || get_the_author_meta('lundi_aprem_ouverture', $curauth->ID) || get_the_author_meta('lundi_aprem_fermeture', $curauth->ID)): ?>
	<li class="date-open-store">
		<span class="">Lundi</span>
		<ul class="">
			<li class=""><?php echo esc_attr(get_the_author_meta('lundi_matin_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('lundi_matin_fermeture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('lundi_aprem_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('lundi_aprem_fermeture', $curauth->ID));
    ?></li>
		</ul>
	</li>
	<?php endif;
    ?>
	
	<?php if (get_the_author_meta('mardi_matin_ouverture', $curauth->ID) || get_the_author_meta('mardi_matin_fermeture', $curauth->ID) || get_the_author_meta('mardi_aprem_ouverture', $curauth->ID) || get_the_author_meta('mardi_aprem_fermeture', $curauth->ID)): ?>
	<li class="date-open-store">
		<span class="">Mardi</span>
		<ul class="">
			<li class=""><?php echo esc_attr(get_the_author_meta('mardi_matin_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('mardi_matin_fermeture', $curauth->ID));
    ?></li>
			
			<li class=""><?php echo esc_attr(get_the_author_meta('mardi_aprem_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('mardi_aprem_fermeture', $curauth->ID));
    ?></li>
		</ul>
	</li>
	<?php endif;
    ?>
	
	
	<?php if (get_the_author_meta('mercredi_matin_ouverture', $curauth->ID) || get_the_author_meta('mercredi_matin_fermeture', $curauth->ID) || get_the_author_meta('mercredi_aprem_ouverture', $curauth->ID) || get_the_author_meta('mercredi_aprem_fermeture', $curauth->ID)): ?>
	<li class="date-open-store">
		<span class="">Mercredi</span>
		<ul class="">
			<li class=""><?php echo esc_attr(get_the_author_meta('mercredi_matin_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('mercredi_matin_fermeture', $curauth->ID));
    ?></li>
			
			<li class=""><?php echo esc_attr(get_the_author_meta('mercredi_aprem_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('mercredi_aprem_fermeture', $curauth->ID));
    ?></li>					
		</ul>
	</li>
	<?php endif;
    ?>
	
	
	<?php if (get_the_author_meta('jeudi_matin_ouverture', $curauth->ID) || get_the_author_meta('jeudi_matin_fermeture', $curauth->ID) || get_the_author_meta('jeudi_aprem_ouverture', $curauth->ID) || get_the_author_meta('jeudi_aprem_fermeture', $curauth->ID)): ?>
	<li class="date-open-store">
		<span class="">Jeudi</span>
		<ul class="">
			<li class=""><?php echo esc_attr(get_the_author_meta('jeudi_matin_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('jeudi_matin_fermeture', $curauth->ID));
    ?></li>
			
			<li class=""><?php echo esc_attr(get_the_author_meta('jeudi_aprem_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('jeudi_aprem_fermeture', $curauth->ID));
    ?></li>
		</ul>
	</li>
	<?php endif;
    ?>
	
	
	<?php if (get_the_author_meta('vendredi_matin_ouverture', $curauth->ID) || get_the_author_meta('vendredi_matin_fermeture', $curauth->ID) || get_the_author_meta('vendredi_aprem_ouverture', $curauth->ID) || get_the_author_meta('vendredi_aprem_fermeture', $curauth->ID)): ?>
	<li class="date-open-store">
		<span class="">Vendredi</span>
		<ul class="">
			<li class=""><?php echo esc_attr(get_the_author_meta('vendredi_matin_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('vendredi_matin_fermeture', $curauth->ID));
    ?></li>
			
			<li class=""><?php echo esc_attr(get_the_author_meta('vendredi_aprem_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('vendredi_aprem_fermeture', $curauth->ID));
    ?></li>
		</ul>
	</li>
	<?php endif;
    ?>
	
	
	<?php if (get_the_author_meta('samedi_matin_ouverture', $curauth->ID) || get_the_author_meta('samedi_matin_fermeture', $curauth->ID) || get_the_author_meta('samedi_aprem_ouverture', $curauth->ID) || get_the_author_meta('samedi_aprem_fermeture', $curauth->ID)): ?>
	<li class="date-open-store">
		<span class="">Samedi</span>
		<ul class="">
			<li class=""><?php echo esc_attr(get_the_author_meta('samedi_matin_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('samedi_matin_fermeture', $curauth->ID));
    ?></li>
			
			<li class=""><?php echo esc_attr(get_the_author_meta('samedi_aprem_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('samedi_aprem_fermeture', $curauth->ID));
    ?></li>
		</ul>
	</li>
	<?php endif;
    ?>
	
	
	<?php if (get_the_author_meta('dimanche_matin_ouverture', $curauth->ID) || get_the_author_meta('dimanche_matin_fermeture', $curauth->ID) || get_the_author_meta('dimanche_aprem_ouverture', $curauth->ID) || get_the_author_meta('dimanche_aprem_fermeture', $curauth->ID)): ?>
	<li class="date-open-store">
		<span class="">Dimanche</span>
		<ul class="">
			<li class=""><?php echo esc_attr(get_the_author_meta('dimanche_matin_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('dimanche_matin_fermeture', $curauth->ID));
    ?></li>
			
			<li class=""><?php echo esc_attr(get_the_author_meta('dimanche_aprem_ouverture', $curauth->ID));
    ?></li>
			<li class=""><?php echo esc_attr(get_the_author_meta('dimanche_aprem_fermeture', $curauth->ID));
    ?></li>
		</ul>
	</li>
	<?php endif;
    ?>
	
</ul>
<?php  endif;
}

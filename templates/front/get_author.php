<?php

function get_Author_Nicename($curauth)
{
    global $wp_query;
    $Nom = $curauth->first_name;
    $Prenom = $curauth->last_name;

    if (!empty($Prenom) || !empty($Nom)) { //si le nom et le prenom sont indiqués alors on les affiche
        echo $curauth->first_name, ' ', $curauth->last_name;
    } else { // sinon on affiche le  login
        echo $curauth->user_login;
    }
}

function get_Autor_Avatar($curauth)
{
    global $wp_query, $current_user;
    get_currentuserinfo();

    $id = $curauth->ID;

    $user_ID = get_current_user_id();
    $change_Avatar_Url = site_url();

    echo get_avatar($id, $size = '325');

    if ($curauth->ID == $user_ID) {
        echo '<a href="'.$change_Avatar_Url.'/edit-avatar" class="edit-img-profil">changer l\'avatar</a>';
    }
}

function get_Author_Phone($curauth)
{
    $tel = $curauth->tel;
    // phone
    if ($tel) {
        ?>
		<span itemprop="telephone" class="glyphicon glyphicon-earphone"> <?php echo $tel;
        ?></span>
	<?php	
    }
}

function get_Author_Url($curauth)
{
    $url = $curauth->user_url;
    // phone
    if ($url) {
        ?>
		<span itemprop="telephone" class="glyphicon glyphicon-link">
			<a href="<?php echo $url;
        ?>" title="<?php echo $url;
        ?>" itemprop="url">
				<?php echo $url;
        ?>
			</a>
		</span>
		<?php	
    }
}

function get_Author_Infos($curauth)
{
    $tel = $curauth->tel;
    $author_Url = $curauth->user_url;
    ?>		
	<h2>Contact</h2>
	<ul class="list-unstyled">
		<li><?php get_full_adress_profil($curauth);
    ?></li>
		<li><?php get_Author_Phone($curauth);
    ?></li>
		<li><?php get_Author_Url($curauth);
    ?></li>
	</ul>
<?php

}
